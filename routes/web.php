<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\BookingController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/venue', [VenueController::class, 'index'])->middleware(['auth', 'verified'])->name('venue');

Route::middleware('auth')->group(function () {
    Route::delete('/venue', [VenueController::class, 'destroy'])->name('venue.destroy');

    Route::get('/venue/add', [VenueController::class, 'add'])->name('venue.add');
    Route::post('/venue/add', [VenueController::class, 'store']);

    Route::get('/venue/{id}/booking', [BookingController::class, 'index'])->name('venue.booking');
    Route::put('/venue/book', [BookingController::class, 'book'])->name('venue.reserve');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
