<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class AdminLocationController extends Controller
{
    /**
     * @author Brighton van Rouendal
     * Show all locations with a search function on country codes
     */
    public function index()
    {
        //
        $search = request()->get('search') ?? '';
        $locations = Location::where('country', 'LIKE', "%{$search}%")->orderBy('country')->paginate(10);
        return view('admin.locations.index', compact('locations'));
    }

    /**
     * @author Brighton van Rouendal
     * Show create form for location
     */
    public function create()
    {
        //
        return view('admin.locations.form', ['location' => new Location]);
    }

    /**
     * @author Brighton van Rouendal
     * Create a new location or throw error when an existing location matches exactly
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
     * @author Brighton van Rouendal
     * Show update form for locations
     */
    public function edit(Location $location)
    {
        //
        return view('admin.locations.form', compact('location'));
    }

    /**
     * @author Brighton van Rouendal
     * Update the location or throw error when an existing location matches exactly
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
     * @author Brighton van Rouendal
     * Soft delete Location and return with 'delete' message
     */
    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('admin.locations.index')->with('delete', 'Location deleted successfully');
    }
}
