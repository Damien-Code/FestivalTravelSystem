<?php

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
Route::get('/festivals', function () {
    return view('festivals.index');
})->name('festivals.index');

Route::get('/festivals/show', function () {
    return view('festivals.show');
})->name('festivals.show');

Route::get('/festivals/order', function () {
    return view('festivals.order');
})->name('festivals.order');
// No login required for contact
Route::get('/contact', function () {
    return view('contact.index');
})->name('contact.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
