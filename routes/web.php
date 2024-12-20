<?php

use App\Http\Controllers\FestivalController;
use App\Http\Controllers\ProfileController;
use App\Models\Festival;
use App\Models\FestivalInfo;
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
Route::get('/festivals/{festival}', function (int $festival) {
    return view('festivals.show', compact('festival'));
})->name('festivals.show');

// No login required for festivals.order
Route::get('/festivals/{festival}/order', function (int $festival) {
    return view('festivals.order', compact('festival'));
})->name('festivals.order');

// No login required for contact
Route::get('/contact', function () {
    return view('contact.index');
})->name('contact.index');

// Login required for admin
Route::get('/admin', function () {
    $festival = Festival::all();
    $festivalInfo = FestivalInfo::all();
    $festivalCount = Festival::all()->count();
    return view('admin.index', compact('festivalCount', 'festival', 'festivalInfo'));
})->middleware(['auth', 'verified'])->name('admin.index');

// Login required for admin
Route::get('/admin/show_users', function () {
    return view('admin.show_users');
})->middleware(['auth', 'verified'])->name('admin.show_users');


// Login required for admin
Route::get('/admin/festivals/create_festivals', function () {
    $festivals = Festival::all();
    $festivalsInfo = FestivalInfo::all();
    return view('admin.festivals.create_festivals', compact('festivals', 'festivalsInfo'));
})->middleware(['auth', 'verified'])->name('admin.festivals.create_festivals');

Route::get('/admin/festivals/edit_festivals/{festival}', function (Festival $festival) {
    return view('admin.festivals.edit_festivals', compact('festival'));
})->middleware(['auth', 'verified'])->name('admin.festivals.edit_festivals');

// Login required for admin
Route::get('/admin/festivals/show_festivals', function () {
    $festivals = Festival::all();
    return view('admin.festivals.show_festivals', compact('festivals'));
})->middleware(['auth', 'verified'])->name('admin.festivals.show_festivals');

Route::patch('/admin/festivals/edit_festivals/{festival}', [FestivalController::class, 'update'])->middleware(['auth', 'verified'])->name('admin.festivals.edit_festivals.update');
// Login required for admin
Route::get('/admin/show_busses', function () {
    return view('admin.show_busses');
})->middleware(['auth', 'verified'])->name('admin.show_busses');

// Routes for image
Route::post('/admin/festivals/create_festivals', [FestivalController::class, 'store'])->name('festivals.store');
Route::post('/admin/show_festivals/storeDate', [FestivalController::class, 'storeDate'])->name('festivals.new');

//Route::resource('admin.festivals', FestivalController::class and FestivalInfo::class )
//    ->only(['index', 'show', 'store', 'edit','update', 'destroy'])
//    ->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
