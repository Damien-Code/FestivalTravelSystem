<?php

use App\Http\Controllers\AdminFestivalController;
use App\Http\Controllers\AdminRouteController;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Models\Festival;
use App\Models\FestivalInfo;
use App\Models\Route as ModelsRoute;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

// No login required for homepage
Route::get('/', function () {
    return view('homepage');
})->name('homepage');

// Login required for dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// No login required for vip
Route::get('/vip', function () {
    return view('vip.index');
})->name('vip.index');


Route::resource('festivals', FestivalController::class)
    ->only(['index', 'show']);

// No login required for festivals.order
Route::get('/festivals/{festival}/order/{route}', function (\App\Models\Festival $festival, \App\Models\Route $route) {
    return view('festivals.order', compact('festival', 'route'));
})->name('festivals.order');

// Route for storing tickets
Route::post('/festivals/{festival}/order/{route}', [OrderController::class, 'store'])->name('order.store');

// No login required for contact
Route::get('/contact', function () {
    return view('contact.index');
})->name('contact.index');

// Login required for admin
Route::get('/admin', function () {
    $festival = Festival::all();
    $festivalInfo = FestivalInfo::all();
    $festivalCount = Festival::all()->count();
    $routesCount = ModelsRoute::all()->count();
    return view('admin.index', compact('festivalCount', 'festival', 'festivalInfo', 'routesCount'));
})->middleware(['auth', 'verified'])->name('admin.index');

// Login required for admin
Route::get('/admin/show_users', function () {
    return view('admin.show_users');
})->middleware(['auth', 'verified'])->name('admin.show_users');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::name('admin.')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::resource('festivals', AdminFestivalController::class)
                ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
            Route::get('/festivals/pair', [AdminFestivalController::class, 'pair'])->name('festivals.pair');
            Route::post('/festivals/planFestival', [AdminFestivalController::class, 'planFestival'])->name('festivals.planFestival');

            Route::resource('/routes', AdminRouteController::class)
                ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
        });
    });
});

// Login required for admin
Route::get('/admin/show_busses', function () {
    return view('admin.show_busses');
})->middleware(['auth', 'verified'])->name('admin.show_busses');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
