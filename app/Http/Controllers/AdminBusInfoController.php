<?php

namespace App\Http\Controllers;

use App\Models\BusInfo;
use Illuminate\Http\Request;

/**
 * @author Mischa Sasse
 */
class AdminBusInfoController extends Controller
{
    /**
     * @author Mischa Sasse
     * @method Illuminate\Http\Request get()
     * @return view + $buses
     * This method gets all buses, puts them in $buses and sends them to the view.
     * If the user searches in the searchbar, then the $busses will change to 
     * hold the values of the buses that match the search fully or partly.
     * 
     */
    public function index()
    {
        $search = request()->get('search') ?? '';
        $busses = BusInfo::where('bus_info.license_plate','like', "%{$search}%")
        ->orderBy('bus_info.id')->paginate(20);
        return view('admin.buses.index', compact('busses'));
    }

    /**
     * @author Mischa Sasse
     * @return view
     * 
     * This method returns a view where an admin can create a bus
     */
    public function create()
    {
        return view('admin.busses.create');
    }

    /**
     * @author Mischa Sasse
     * @param Request $request
     * @method Illuminate\Http\Request validate()
     * @method Illuminate\Routing\Redirector back()
     * @method Illuminate\Routing\Redirector route()
     * @method Illuminate\Routing\Redirector with()
     * @method Illuminate\Http\RedirectResponse withErrors()
     * 
     * This method first checks the validity of the incoming post-data.
     * After this it checks if the post-data, the given license plate, already exists
     * If this is the case, it will return an error to the user,
     * else it will create the bus with the given license plate and 
     * returns the user to the busses.index page with a success message.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'license_plate' => 'required|string|min:6|max:6',
        ]);
        $bus = BusInfo::where('license_plate', $validated['license_plate'])->first();
        if ($bus !== null) {
            return redirect()->back()->withErrors(['error' => 'Bus already exists!']);
        }

        BusInfo::create([
            'license_plate' => strtoupper($validated['license_plate']),
        ]);
        return redirect()->route('admin.busses.index')->with('success', 'Bus created successfully');
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
     * @author Mischa Sasse
     * @param $bus
     * @return view + message
     * @method Illuminate\Http\RedirectResponse with()
     * @method Illuminate\Routing\Redirector route()
     * @return view + message
     * 
     * This method first gets the data of the bus from the database.
     * Then it soft-deletes the bus from the database
     * then it redirects the user back to the admin.busses.index page with a delete message.
     */
    public function destroy($bus)
    {
        $busData = BusInfo::where('id',$bus)->get()[0];
        $busData->delete();
        return redirect()->route('admin.busses.index')->with('delete', 'Bus deleted successfully');
    }
}