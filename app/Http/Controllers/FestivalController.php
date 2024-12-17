<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use App\Models\Festival_info;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
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

        // Check if there is a search
        // If there is, check the search value with db
        if(request()->has('search')) {
            $search = request()->get('search');
            /** https://stackoverflow.com/questions/38631486/laravel-query-model-if-values-contain-a-certain-string-taken-from-search-inpu */
            $festivals = Festival::join('festival_info', 'festival_info.id', '=', 'festivals.info_festival_id')
                ->where('festival_info.title', 'like', '%' . $search . '%')
                ->get();
        }
        return view('festivals.index', compact('festivals'));
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
