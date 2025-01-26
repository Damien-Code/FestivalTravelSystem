<?php

namespace App\Http\Controllers;

use App\Models\BusInfo;
use App\Models\BusInUse;
use App\Models\Festival;
use App\Models\Order;
use App\Models\Route;
use App\Models\User;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * @author Brighton van Rouendal
     * Display the specified resource.
     */
    public function show(Festival $festival, Route $route)
    {
        $now = Carbon::now();
        if ($route->departure_time < $now)
            return redirect()->route('festivals.show', $festival)->withErrors(['Departure Time' => "Departure Time must be after {$now}"]);
        return view('festivals.order', compact('festival', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @author Ismael Winterman
     */
    public function store(Request $request, Festival $festival, Route $route)
    {
        //Redirect back if route date has already happened
        $now = Carbon::now();
        if ($route->departure_time < $now)
            return redirect()->route('festivals.show', $festival)->withErrors(['Departure Time' => "Departure Time must be after {$now}"]);

        //Identify user making the purchase
        $user = auth()->user();

        //Validate form data
        $validatedData = $request->validate([
            'ticket-amount' => 'required|numeric|min:1|max:35',
            'total-price-h' => 'required|numeric',
        ]);

        //Validate if the user has enough tokens if checkbox is selected
        if($request->has('vip-checkbox') && $user->tokens < 100) {
            //Set error msg and return to order screen
            return redirect()->back()->withErrors(['Invalid tokens' => 'You do not have enough tokens to use the discount feature.']);
        }

        //Validate submitted price rounded on 2 decimals
        if($request->get('total-price-h') != round($route->price * $request->get('ticket-amount') * ($request->has('vip-checkbox') ? 0.8 : 1.0), 2)) {
            //Set error msg and return to order screen
            return redirect()->back()->withErrors(['Invalid price' => 'The submitted price is incorrect. Please try again.']);
        }

        //Try to schedule a new bus if ordered ticket quantity exceeds the scheduled bus capacity
        $isCapacityRemaining = $this->CapacityCheck($route, $validatedData['ticket-amount']);

        //If no capacity remains, send a message with relevant information to the administrators & display a message to the user.
        if (!$isCapacityRemaining) {
            Contact::create([
                'name' => 'ADMIN',
                'email' => 'busplanner@fts.com',
                'message' => "There were no buses or drivers available to be scheduled in for festival #{$festival->id} on route #{$route->id}."
            ]);
            return redirect()->back()->withErrors(['Bus Route' => 'Your order exceeds the remaining capacity of our available buses. A message has been sent to the administrators. Please try again later.']);
        }

        //Save the order
        Order::create([
            'user_id' => $user->id,
            'route_id' => $route->id,
            'tokens_used' => $request->has('vip-checkbox') ? 100 : 0,
            'amount_of_tickets' => $validatedData['ticket-amount'],
            'final_price' => $validatedData['total-price-h'],
        ]);

        //Remove points if VIP option was selected
        if($request->has('vip-checkbox')) {
            $user->update(['tokens' => $user->tokens - 100]);
        }

        //Award tokens based on final price
        $user->update(['tokens' => $user->tokens + $validatedData['total-price-h']]);

        //return redirect()->route('festivals.index');
        return redirect()->route('festivals.show', $festival)->with('success', 'Your order has been placed!');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * @author Ismael Winterman, Brighton van Rouendal
     * Soft delete Order so that user can cancel it and remove tokens from user
     */
    public function destroy(Order $order)
    {
        //
        $user = auth()->user();
        if ($user->id == $order->user_id) {
            $user->tokens -= $order->final_price;
            $user->save();
            $order->delete();
            return redirect()->back()->with('success', 'Your order has been cancelled!');
        }
        return redirect()->back()->withErrors(['Incorrect order' => "Incorrect order id was given does not belong to {$user->name}."]);
    }

    /**
     * Automatic bus planning trigger.
     * Check if the quantity of tickets in the current order exceeds the capacity of the scheduled buses.
     * If it does, checks if there are any available buses and drivers on that day and schedules them in.
     * @author Ismael Winterman, Brighton van Rouendal
     * *brighton -> bus planning function check if available bus and driver.
     */
    private function CapacityCheck($route, $tickets) : bool {
        //Count how many buses are scheduled, the amount of signups and capacity of currently scheduled buses. A bus can hold 35 people
        $scheduledBuses = BusInUse::Where('route_id', $route->id)->count();
        $scheduledCapacity = $scheduledBuses * 35;
        $signups = $route->signups();

        //Exit out when there is enough capacity remaining
        if (($signups + $tickets) <= $scheduledCapacity) {
            return true;
        }
        elseif (($signups + $tickets) > $scheduledCapacity) {
            //Remove seconds from the departure time
            $date = Carbon::parse($route->departure_time)->format('Y-m-d');

            //Find all buses that are in use on the routes departure date
            $busInUse = BusInUse::withWhereHas('routes', function ($query) use ($date) {
                $query->whereBetween('departure_time', [$date.' 00:00:00', $date.' 23:59:59',]);
            })->get();

            //Check if there is an available bus on the departure date
            $bus = BusInfo::whereNotIn('id', $busInUse->pluck('bus_id'))->first();
            if ($bus == null)
                return false;

            //Check if there is an available bus driver on the departure date
            $user = User::where('role_id', 3)->whereNotIn('id', $busInUse->pluck('user_id'))->first();
            if ($user == null)
                return false;

            //Schedule a bus for this route
            BusInUse::create([
                'route_id' => $route->id,
                'user_id' => $user->id,
                'bus_id' => $bus->id,
            ]);
            return true;
        }
        return false;
    }
}
