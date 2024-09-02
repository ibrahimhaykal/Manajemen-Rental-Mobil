<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    
});

Route::get('/dashboard', DashboardController::class)->name('dashboard');
Route::middleware(['auth'])->resource('/cars', CarController::class);
Route::resource('car', CarController::class);
Route::get('/cars', [CarController::class, 'index'])->name('car.index');

Route::middleware(['auth'])->resource('/rentals', RentalController::class);
Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');
Route::resource('rental', RentalController::class);
Route::post('rental/{rental:id}/status', [RentalController::class, 'status'])->name('rental.status');

Route::middleware(['auth'])->resource('/user', UserController::class);
Route::middleware(['auth'])->resource('/returns', ReturnController::class);
// Tampilkan formulir pengembalian
Route::get('/returns/form', [ReturnController::class, 'createForm'])->name('returns.form');
Route::get('/returns', [ReturnController::class, 'index'])->name('returns.index');
// Simpan pengembalian
Route::post('/returns', [ReturnController::class, 'store'])->name('returns.store');
require __DIR__.'/auth.php';
