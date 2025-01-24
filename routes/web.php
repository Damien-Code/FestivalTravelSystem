<?php

use App\Http\Controllers\AdminContactController;
use App\Http\Controllers\AdminFestivalController;
use App\Http\Controllers\AdminLocationController;
use App\Http\Controllers\AdminRouteController;
use App\Http\Controllers\AdminBusInfoController;
use App\Models\BusInfo;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Models\Contact;
use App\Models\Festival;
use App\Models\Location;
use App\Models\Route as ModelsRoute;
use Illuminate\Support\Facades\Route;
use App\Models\User;

// Unused route for this application, but page is used in some layouts
Route::get('/welcome', function () {
    return view('welcome');
});

// No login required for homepage
Route::get('/', function () {
    return view('homepage');
})->name('homepage');

// Login required for dashboard
Route::get('/dashboard', function () {
    $orders = auth()->user()->orders;
    return view('dashboard', compact('orders'));
})->middleware(['auth', 'verified'])->name('dashboard');

// No login required for vip
Route::get('/vip', function () {
    return view('vip.index');
})->name('vip.index');

Route::resource('festivals', FestivalController::class)
    ->only(['index', 'show']);

// Login required for festivals.order
Route::get('/festivals/{festival}/order/{route}', function (Festival $festival, ModelsRoute $route) {
    return view('festivals.order', compact('festival', 'route'));
})->name('festivals.order')->middleware('auth');

// Route for storing tickets
Route::post('/festivals/{festival}/order/{route}', [OrderController::class, 'store'])->name('order.store');

// No login required for contact
Route::resource('contact', ContactController::class)
    ->only('index', 'store');

// Grouped routes for all the routes that belong to admin
// Login required for admin & admin account needed
Route::middleware(['admin', 'auth', 'verified'])->group(function () {
    Route::name('admin.')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', function () {
                $usersCount = User::withoutTrashed()->count();
                $festivalsCount = Festival::withoutTrashed()->count();
                $busCount = BusInfo::withoutTrashed()->count();
                $routesCount = ModelsRoute::withoutTrashed()->count();
                $contactsCount = Contact::withoutTrashed()->count();
                $locationsCount = Location::withoutTrashed()->count();
                return view('admin.index', compact('usersCount', 'festivalsCount', 'busCount', 'routesCount', 'contactsCount', 'locationsCount'));
            })->name('index');

            Route::resource('festivals', AdminFestivalController::class)
                ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
            Route::get('/festivals/pair', [AdminFestivalController::class, 'pair'])->name('festivals.pair');
            Route::post('/festivals/planFestival', [AdminFestivalController::class, 'planFestival'])->name('festivals.planFestival');
            Route::put('/festivals/{festival}', [AdminFestivalController::class, 'updatePair'])->name('festivals.updatePair');

            Route::resource('routes', AdminRouteController::class)
                ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

            Route::resource('users', AdminController::class)
                ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

            Route::resource('locations', AdminLocationController::class)
                ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

            Route::resource('busses', AdminBusInfoController::class)
                ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

            Route::resource('contact', AdminContactController::class)
                ->only(['index', 'show', 'destroy']);
        });
    });
});

// Routes for profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
