<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use App\Models\Festival_info;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FestivalController extends Controller
{
    /**
     * @author Damiën van den IJssel
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\View
     */
    public function index() : View
    {
        $festivals = Festival::all();
        $festivalInfo = Festival_info::all();
        if(request()->has('search')){
            $festivals = Festival::where('name', 'like', '%'.request('search').'%')->get();
        }
        return view('festivals.index', compact('festivals', 'festivalInfo'));
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
    public function show(Festival $festival)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Festival $festival)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Festival $festival)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Festival $festival)
    {
        //
    }
}
