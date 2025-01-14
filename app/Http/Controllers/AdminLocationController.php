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
        $locations = Location::all()->sortBy('country');
        return view('admin.locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.locations.form', ['location' => new Location]);
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
//        $location = Location::all()->where('country', $validated['country'])->where('city', $validated['city'])->where('street', $validated['street'])->first();
        $location = Location::where('country', $validated['country'])->where('city', $validated['city'])->where('street', $validated['street'])->first();
        if ($location !== null) {
            return redirect()->back()->withErrors(['error' => 'Location already exists!']);
        }

        Location::create([
            'country' => strtoupper($validated['country']),
            'city' => $validated['city'],
            'street' => $validated['street'],
        ]);
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
        return view('admin.locations.form', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        //
        $validated = $request->validate([
            'country' => 'required|string|min:2|max:2',
            'city' => 'required|string|max:50',
            'street' => 'required|string|max:50',
        ]);
        $location_exists = Location::where('country', $validated['country'])->where('city', $validated['city'])->where('street', $validated['street'])->first();
        if ($location_exists !== null) {
            return back()->withErrors(['error' => 'Location already exists!']);
        }
        $location->update([
            'country' => strtoupper($validated['country']),
            'city' => $validated['city'],
            'street' => $validated['street'],
        ]);
        return redirect()->route('admin.locations.index')->with('success', 'Location updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        //
        $f = $location->festivals()->count();
        $r = $location->routes()->count();
//        if ($f === 0 && $r === 0) {
            $location->delete();
            return redirect()->route('admin.locations.index')->with('delete', 'Location deleted successfully');
//        } else {
//            return redirect()->route('admin.locations.index')->withErrors(['error' => 'Location cannot be deleted!', 'invalid' => "linked festival amount: {$f}, routes amount: {$r}"]);
//        }
    }
}
