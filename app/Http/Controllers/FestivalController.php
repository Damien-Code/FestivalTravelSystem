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
        })->orderBy('festivals.date')->paginate(15);
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
        // Validate the request and resource
        $validatedData = $request->validate([
            'title' => 'required|string|max:45|min:3',
            'description' => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        // Encode the uploaded image to base64
        // Image is nullable, so added if statement
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $data = "data:image/{$image->extension()};base64, ";
            $data .= base64_encode($image->openFile()->fread($image->getSize()));
        }
        // create the resource
        FestivalInfo::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $data ?? null // add image or null
        ]);
        return redirect()->route('admin.festivals.create_festivals');
    }


    // Store an added festival and date to db
    // Get the added festival from the store method and add a location and date to it
    public function storeDate(Request $request)
    {
        $validatedData = $request->validate([
            'festival' => 'required',
            'date' => 'required|date',
        ]);
        Festival::create([
            'info_festival_id' => $validatedData['festival'],
            'location_id' => 1, // TODO: make admin be able to assign location
            'date' => $validatedData['date'],
        ]);
        return redirect()->route('admin.festivals.create_festivals');
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
    public function update(Request $request, FestivalInfo $festivalInfo, Festival $festival)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:45|min:3',
            'description' => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        // Encode the uploaded image to base64
        // Image is nullable, so added if statement
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $data = "data:image/{$image->extension()};base64, ";
            $data = base64_encode($image->openFile()->fread($image->getSize()));
        }
        // Update the resource
        $festival->festivalInfo()->update($validatedData);
        return redirect(route('admin.festivals.show_festivals'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Festival $festival)
    {
        //
    }
}
