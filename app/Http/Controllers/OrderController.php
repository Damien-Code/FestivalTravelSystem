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
     */
    public function store(Request $request, Festival $festival, Route $route)
    {
        //Validate form data
        $validatedData = $request->validate([
            'ticket-amount' => 'required|numeric|min:1|max:35',
            'total-price' => 'required|numeric',
        ]);

        //Validate submitted price
        if($request->get('total-price') != $route->price * $request->get('ticket-amount') * ($request->has('vip-checkbox') ? 0.8 : 1.0)) {
            //Set error msg and return to order screen
            return redirect()->back()->withErrors(['error' => 'The submitted price is incorrect. Please try again.']);
        }

        //TODO: subtract/add points to the user

        Order::create([
            'user_id' => auth()->user()->id,
            'route_id' => $route->id,
            'tokens_used' => $request->has('vip-checkbox') ? 100 : 0,
            'amount_of_tickets' => $validatedData['ticket-amount'],
            'final_price' => $validatedData['total-price'],
        ]);
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
