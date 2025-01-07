<?php

namespace App\Http\Controllers;

use App\Models\BusInfo;
use App\Models\BusInUse;
use App\Models\Festival;
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
        })->orderBy('routes.departure_time')->paginate(15);
        return view('admin.routes.index', compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $festivals = Festival::with('festivalInfo')->where('date', '>=', now())->orderBy('date')->get();

        return view('admin.routes.create', compact('festivals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'festival' => 'required',
            'location' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'price' => 'required',
        ]);
        $busInUse = BusInUse::withWhereHas('routes', function ($query) use ($validated) {
            $query->whereBetween('departure_time', [$validated['date'].' 00:00:00', $validated['date'].' 23:59:59',]);
        })->get();

        $bus = BusInfo::whereNotIn('id', $busInUse->pluck('id'))->first();
        if ($bus == null) {
            return redirect()->back()->withErrors('bus', 'No Bus Available On This Date');
        }

        $user = User::where('role_id', '=', 3)->withWhereHas('busInUse', function ($query) use ($busInUse) {
            $query->whereNotIn('id', $busInUse->pluck('id'));
        })->first();

        $route = Route::create([
            'festival_id' => $validated['festival'],
            'location_id' => 1,
            'departure_time' => $validated['date'],
            'date' => now()->format('Y-m-d'),
            'price' => $validated['price'],
        ]);

        BusInUse::create([
            'route_id' => $route->id,
            'user_id' => $user->id,
            'bus_id' => $bus->id,
        ]);

        return redirect()->route('admin.routes.index');
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Route $route)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        //
    }
}
