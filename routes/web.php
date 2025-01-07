<?php

use App\Http\Controllers\FestivalController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
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

// No login required for festivals
//Route::get('/festivals', function () {
//    return view('festivals.index');
//})->name('festivals.index');

Route::resource('festivals', FestivalController::class)
    ->only(['index', 'show', 'store', 'update', 'destroy']);


// No login required for festivals.show
Route::get('/festivals/{festival}', function (\App\Models\Festival $festival) {
    $festival->load(['routes']);
    return view('festivals.show', compact('festival'));
})->name('festivals.show');

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
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('admin.index');

Route::get('/admin/show_users', function () {
    return view('admin.show_users');
})->middleware(['auth', 'verified'])->name('admin.show_users');

Route::get('/admin/show_festivals', function () {
    return view('admin.show_festivals');
})->middleware(['auth', 'verified'])->name('admin.show_festivals');

Route::get('/admin/show_busses', function () {
    return view('admin.show_busses');
})->middleware(['auth', 'verified'])->name('admin.show_busses');

// Routes for image
Route::post('/admin/show_festivals', [FestivalController::class, 'store'])->name('festivals.store');

//Route::get('/festivals',[FestivalController::class, 'decodeImage']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
