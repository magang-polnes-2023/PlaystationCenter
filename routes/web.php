<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Models\Booking;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'home']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/playstation', [HomeController::class, 'index'])->name('playstation');
Route::get('/playstation/booking/{id}', [BookingController::class, 'create'])->name('booking');
Route::post('/playstation/booking/card', [BookingController::class, 'store'])->name('card');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->get('/history', [OrderController::class, 'order'])->name('order.order');
Route::put('/history/{id}', [OrderController::class, 'update'])->name('upload');
Route::get('/history/view/{id}', [OrderController::class, 'index'])->name('order.view');
Route::delete('/history/{id}', [OrderController::class, 'cancle'])->name('order.cancle');

require __DIR__ . '/auth.php';
