<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use App\Models\Order;
use App\Models\Route;
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
     * Store a newly created resource in storage.
     * @author Ismael Winterman
     */
    public function store(Request $request, Festival $festival, Route $route)
    {
        //Identify user making the purchase
        $user = auth()->user();



        //Validate form data
        $validatedData = $request->validate([
            'ticket-amount' => 'required|numeric|min:1|max:35',
            'total-price' => 'required|numeric',
        ]);

        //Validate if the user has enough tokens if checkbox is selected
        if($request->has('vip-checkbox') && $user->tokens < 100) {
            //Set error msg and return to order screen
            return redirect()->back()->withErrors(['Invalid tokens' => 'You do not have enough tokens to use the discount feature.']);
        }

        //Validate submitted price rounded on 2 decimals
        if($request->get('total-price') != round($route->price * $request->get('ticket-amount') * ($request->has('vip-checkbox') ? 0.8 : 1.0), 2)) {
            //Set error msg and return to order screen
            return redirect()->back()->withErrors(['Invalid price' => 'The submitted price is incorrect. Please try again.']);
        }

        //Save the order
        Order::create([
            'user_id' => $user->id,
            'route_id' => $route->id,
            'tokens_used' => $request->has('vip-checkbox') ? 100 : 0,
            'amount_of_tickets' => $validatedData['ticket-amount'],
            'final_price' => $validatedData['total-price'],
        ]);

        //Remove points if VIP option was selected
        if($request->has('vip-checkbox')) {
            $user->update(['tokens' => $user->tokens - 100]);
        }

        //Award tokens based on final price
        $user->update(['tokens' => $user->tokens + $validatedData['total-price']]);

        return redirect()->route('festivals.index');
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
