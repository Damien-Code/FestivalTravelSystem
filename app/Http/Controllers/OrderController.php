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
    public function index(Request $request) : RedirectResponse
    {
        //
        return Redirect::route('festival.order');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created Order in the database.
     * @param Request $request The post request data.
     * @param Festival $festival The festival that the current order is made for.
     * @param Route $route The route that the current order is made for.
     * @return RedirectResponse Returns the user back to the festival page that the order was placed for.
     * @author Ismael Winterman
     */
    public function store(Request $request, Festival $festival, Route $route)
    {
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
     * Soft delete Order so that user can cancel it and remove tokens from user.
     * @param Order $order The order the user wants to cancel.
     * @return RedirectResponse Redirect the user to the dashboard with a messaging indicating if cancelling the order was successful.
     * @author Ismael Winterman, Brighton van Rouendal
     */
    public function destroy(Order $order)
    {
        //Identify user cancelling their order
        $user = auth()->user();

        if ($user->id == $order->user_id) {
            //Refund points spent by the user if applicable
            if($order->tokens_used > 0)
                $user->tokens += $order->tokens_used;

            //Take points obtained through the order back from the user
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
     * @param Route $route The route the user is trying to place an order on.
     * @param Int $tickets The amount of tickets the user is trying to buy.
     * @return bool Returns true when there is enough capacity remaining or a new bus was successfully scheduled. Returns false if no bus or bus driver is available.
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
