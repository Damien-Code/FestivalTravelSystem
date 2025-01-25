<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class FestivalController extends Controller
{
    /**
     * @return View
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @author Damiën van den IJssel & Brighton van Rouendal
     * Display a listing of the resource.
     */
    public function index(): View
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
        })->with('location')->where('date', '>=', now())->orderBy('festivals.date')->paginate(10);
        return view('festivals.index', compact('festivals'));
    }

    /**
     * @param Festival $festival
     * @return View|RedirectResponse
     * Display the specified resource.
     * @author Damiën van den IJssel
     */
    public function show(Festival $festival): View|RedirectResponse
    {
        if ($festival->date < now())
            return redirect()->route('festivals.index');
        return view('festivals.show', compact('festival'));
    }
}
