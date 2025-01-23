<?php

namespace App\Http\Controllers;

use App\Models\BusInfo;
use App\Models\BusInUse;
use App\Models\Festival;
use App\Models\Location;
use App\Models\Route;
use App\Models\User;
use Illuminate\Http\Request;

class AdminRouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $search = request()->get('search') ?? '';
        $routes = Route::withWhereHas('festival', function ($query) use ($search) {
            $query->withWhereHas('festivalInfo', function ($query2) use ($search) {
                $query2->where('festival_info.title', 'like', "%{$search}%");
            });
        })->where('departure_time', '>=', now())->orderBy('routes.departure_time')->paginate(15);
        return view('admin.routes.index', compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $festivals = Festival::with('festivalInfo')->where('date', '>=', now())->orderBy('date')->get();
        $locations = Location::withoutTrashed()->get();
        $route = new Route;
        return view('admin.routes.create', compact('festivals', 'locations', 'route'));
    }

    /**
     * @author Brighton van Rouendal
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'festival' => 'required',
            'location' => 'required|integer',
            'date' => 'required|date',
            'time' => 'required',
            'price' => 'required',
        ]);

        //Find all buses that are in use on the routes departure date
        $busInUse = BusInUse::withWhereHas('routes', function ($query) use ($validated) {
            $query->whereBetween('departure_time', [$validated['date'].' 00:00:00', $validated['date'].' 23:59:59',]);
        })->get();

        //Check if there is an available bus on the departure date
        $bus = BusInfo::whereNotIn('id', $busInUse->pluck('bus_id'))->first();
        if ($bus == null)
            return redirect()->back()->withErrors('bus', 'No Bus Available On This Date');

        //Check if there is an available bus driver on the departure date
        $user = User::where('role_id', 3)->whereNotIn('id', $busInUse->pluck('user_id'))->first();
        if ($user == null)
            return redirect()->back()->withErrors('driver', 'No Driver Available For This Day');


        $route = Route::create([
            'festival_id' => $validated['festival'],
            'location_id' => $validated['location'],
            'departure_time' => $validated['date'] . ' ' . $validated['time'],
            'price' => $validated['price'],
        ]);

        BusInUse::create([
            'route_id' => $route->id,
            'user_id' => $user->id,
            'bus_id' => $bus->id,
        ]);

        return redirect()->route('admin.routes.index')->with('success', 'Route Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Route $route)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Route $route)
    {
        //
        $festivals = Festival::with('festivalInfo')->where('date', '>=', now())->orderBy('date')->get();
        $locations = Location::withoutTrashed()->get();
        return view('admin.routes.create', compact('festivals', 'locations', 'route'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Route $route)
    {
        $validated = $request->validate([
            'festival' => 'required',
            'location' => 'required|integer',
            'date' => 'required|date',
            'time' => 'required',
            'price' => 'required',
        ]);

        $route->update([
            'festival_id' => $validated['festival'],
            'location_id' => $validated['location'],
            'departure_time' => $validated['date'] . ' ' . $validated['time'],
            'price' => $validated['price'],
        ]);

        return redirect()->route('admin.routes.index')->with('success', 'Route Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        //
        $route->delete();
        return redirect()->route('admin.routes.index')->with('success', 'Route Deleted Successfully');
    }
}
