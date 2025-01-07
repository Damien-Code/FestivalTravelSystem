<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use App\Models\Order;
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
    public function store(Request $request)
    {
        //TODO:Ticket processing
        $validatedData = $request->validate([
            //tokens_used?
            //user_id doesn't need to be validated?
            //'user_id' => 'required',
            //can final_price be calculated and validated here?
            //price validation here?
            'route-id' => 'required',
            'ticket-amount' => 'required',
            'total-price' => 'required',
        ]);

        Order::create([
            'user_id' => auth()->user()->id,
            'route_id' => $validatedData['route-id'],
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
