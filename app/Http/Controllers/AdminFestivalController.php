<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use App\Models\FestivalInfo;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use PHPUnit\Runner\ErrorException;
use PHPUnit\TextUI\Application;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use function Laravel\Prompts\error;
use function PHPUnit\Framework\throwException;

class AdminFestivalController extends Controller
{
    /**
     * @return View
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * Display a listing of the resource.
     * @author Damiën van den IJssel & Brighton van Rouendal
     */
    public function index(): View
    {
        // Check if there is a search
        // If there is, check the search value with db
        $search = request()->get('search') ?? '';
        $festivals = Festival::withWhereHas('festivalInfo', function ($query) use ($search) {
            $query->where('festival_info.title', 'like', "%{$search}%");
            // Order the festivals on date
        })->orderBy('festivals.date')->paginate(20);

        return view('admin.festivals.index', compact('festivals'));
    }

    /**
     * @return View
     * @author Damiën van den IJssel
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $festivalsInfo = FestivalInfo::all();
        return view('admin.festivals.create', compact('festivalsInfo'));
    }

    /**
     * @return RedirectResponse
     * Store a newly created resource in storage.
     * @author Damiën van den IJssel
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the request and resource
        $validatedData = $request->validate([
            'title' => 'required|string|max:45|min:3',
            'description' => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
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
        return redirect()->route('admin.festivals.create')->with('success', 'Festival created successfully!');
    }

    /**
     * @return View
     * Show the form for pairing festival
     * @author Damiën van den IJssel
     */
    public function pair(): View
    {
        $festivalsInfo = FestivalInfo::all();
        return view('admin.festivals.pair', compact('festivalsInfo'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @author Damiën van den IJssel
     */
    // Store an added festival and date to db
    // Get the added festival from the store method and add a location and date to it
    public function planFestival(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'festival' => 'required',
//            'location' => 'required',
            'date' => 'required|date',
        ]);

        Festival::create([
            'info_festival_id' => $validatedData['festival'],
//            'location_id' => $validatedData['location'],
            'location_id' => 1, // TODO: make admin be able to assign location
            'date' => $validatedData['date'],
        ]);
        return redirect()->route('admin.festivals.pair')->with('success', 'Festival paired successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Festival $festival)
    {
        //
    }

    /**
     * @return View
     * Show the form for editing the specified resource.
     * @author Damiën van den IJssel
     */
    public function edit(Festival $festival): View
    {
        $festivalsInfo = FestivalInfo::all();
        return view('admin.festivals.edit', compact('festival', 'festivalsInfo'));
    }

    /**
     * @return RedirectResponse
     * Update the specified resource in storage.
     * @author Damiën van den IJssel
     */
    public function update(Request $request, Festival $festival): RedirectResponse
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
            $data .= base64_encode($image->openFile()->fread($image->getSize()));
        }
        // Update the resource
        $festival->festivalInfo()->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $data ?? null
        ]);
        return redirect(route('admin.festivals.edit', $festival))
            ->with('success', 'Festival updated successfully!');
    }

    public function updatePair(Request $request, Festival $festival): RedirectResponse
    {
        $validatedData = $request->validate([
            'festival' => 'required',
//            'location' => 'required',
            'date' => 'required|date',
        ]);
//      Convert date to datetime because otherwise the planning won't update
//      Convert to datetime was needed because datatype in database is datetime, while the calendar makes a date
        Carbon::parse($validatedData['date'])->toDateTimeString();
        $festival->update([
            'info_festival_id' => $validatedData['festival'],
//            'location_id' => $validatedData['location'],
            'location_id' => 1,
            'date' => $validatedData['date'],
        ]);
        return redirect(route('admin.festivals.edit', $festival))
            ->with('success', 'Pairing festival updated successfully!');

    }

    /**
     * @return RedirectResponse
     * Remove the specified resource from storage.
     * @author Damiën van den IJssel
     */
    public function destroy(Festival $festival): RedirectResponse
    {
        $festival->delete();
        return redirect()->route('admin.festivals.index')
            ->with('delete', 'Festival deleted successfully!');
    }
}
