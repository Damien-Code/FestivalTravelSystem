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
        $festivals = Festival::all();

        // Check if there is a search
        // If there is, check the search value with db
        if(request()->has('search')) {
            $search = request()->get('search');
            /**
             * https://stackoverflow.com/questions/38631486/laravel-query-model-if-values-contain-a-certain-string-taken-from-search-inpu
             * https://dev.to/othmane_nemli/laravel-wherehas-and-with-550o
             */
            $festivals = Festival::withWhereHas('festivalInfo', function ($query) use ($search) {
                $query->where('festival_info.title', 'like', "%{$search}%");
            })->get();
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
        $validatedData = $request->validate([
            'title' => 'required|string|max:45|min:3',
            'description' => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $image = $request->file('image');
        $data = "data:image/{$image->extension()};base64, ";
        $data .= base64_encode($image->openFile()->fread($image->getSize()));

        FestivalInfo::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $data,
        ]);
        return redirect()->route('admin.show_festivals');
    }

    // Decode the blob from db
//    public function decodeImage()
//    {
//        $festivals = Festival_info::all();
//        $file_contents = base64_decode(request('image'));
//        dd(request('image'));
//        return view('festivals.index', compact('file_contents'));
//    }

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
