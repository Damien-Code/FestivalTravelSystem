<?php

namespace App\Http\Controllers;

use App\Models\Route;
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
        return view('admin.routes.create');
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
