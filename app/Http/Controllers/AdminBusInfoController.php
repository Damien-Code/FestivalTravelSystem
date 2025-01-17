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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        return redirect(route('admin.busses.index'));
    }
}
