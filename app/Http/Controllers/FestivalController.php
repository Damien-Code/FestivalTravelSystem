<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use App\Models\FestivalInfo;
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
        // Check if there is a search
        // If there is, check the search value with db
        $search = request()->get('search') ?? '';
        /**
         * https://stackoverflow.com/questions/38631486/laravel-query-model-if-values-contain-a-certain-string-taken-from-search-inpu
         * https://dev.to/othmane_nemli/laravel-wherehas-and-with-550o
         */
        $festivals = Festival::withWhereHas('festivalInfo', function ($query) use ($search) {
            $query->where('festival_info.title', 'like', "%{$search}%");
            // Order the festivals on date
        })->with('location')->orderBy('festivals.date')->paginate(15);
        return view('festivals.index', compact('festivals'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Festival $festival)
    {
        //
        return view('festivals.show', compact('festival'));
    }
}
