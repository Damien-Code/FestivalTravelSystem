<?php

namespace App\Http\Controllers;

use App\Models\BusInfo;
use Illuminate\Http\Request;

class AdminBusInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->get('search') ?? '';
        $busses = BusInfo::where('bus_info.license_plate','like', "%{$search}%")
        ->orderBy('bus_info.id')->paginate(20);
        return view('admin.busses.index', compact('busses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.busses.create');
    }

    /**
     * Store a newly created resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(BusInfo $bus)
    {
        $bus->delete();
        dd("test", $bus->delete());
        return redirect(route('admin.busses.index'));
    }
}
