<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ManagerController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
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

Route::redirect('/home', '/', 301);

Route::inertia('/', 'index')->name('home-page');

Route::inertia('/hotels', 'hotels')->name('all-hotels-page');
Route::get('/hotel/{id}', function ($id) {
    return Inertia::render('detailHotel', [
        'id' => $id,
    ]);
})->name('hotel-page');

Route::inertia('/login', 'login')->name('login-page');
Route::inertia('/register', 'register')->name('register-page');
Route::get('/logout', [UserController::class, 'getLogout'])->name('logout');

Route::middleware(['CekRole:1'])->group(function () {
    Route::inertia('/favourites', 'favourites')->name('favourites-page');
    Route::inertia('/bookings/complete', 'book')->name('book-page');
});

Route::middleware(['CekRole:0'])->group(function () {
});
Route::inertia('/admin', 'admin')->name('admin-page');
Route::get('/admin/invoice/{id}', function ($id) {
    return Inertia::render('invoice', [
        'id' => $id,
    ]);
})->name('invoice-page');



Route::inertia('/coba', 'coba');


/**
 * Testing
 */
Route::get('/test', function () {
    try {
        // Session::put('key', 'value');
        dd(Session::all());
        return Auth::user();

        return response()->json([
            'message' => 'Hello World!',
        ], 200);
    } catch (\Throwable $th) {
        return response()->json([
            'message' => $th->getMessage(),
        ], 404);
    }
})->middleware(['web']);

require __DIR__ . '/auth.php';
