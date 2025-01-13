<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class AdminLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.locations.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'country' => 'required|string|min:2|max:2',
            'city' => 'required|string|max:50',
            'street' => 'required|string|max:50',
        ]);

        $location = Location::where('country', $validated['country'])->where('city', $validated['city'])->where('street', $validated['street'])->first();
        if ($location->exists()) {
            return back()->with('error', 'Location already exists!');
        }

        Location::create($validated);
        return redirect()->route('admin.locations.index')->with('success', 'Location created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        //
    }
}
