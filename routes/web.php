<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ManagerController;
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

Route::redirect('home', '/', 301);

Route::inertia('/', 'index')->name('home-page');
Route::inertia('/hotels', 'hotels')->name('all-hotels-page');
// Route::inertia('/hotel/{id}', 'detail-hotel')->name('hotel-page');

Route::get('/hotel/{id}', function ($id) {
    return Inertia::render('detailHotel', [
        'id' => $id,
    ]);
})->name('hotel-page');

Route::inertia('/login', 'login')->name('login-page');
Route::inertia('/register', 'register')->name('register-page');


// Route::inertia('/', 'index')->name('home-page');
Route::inertia('/hotels', 'hotels')->name('all-hotels-page');
Route::inertia('/favourites', 'favourites')->name('favourites-page');

Route::inertia('/coba', 'coba');

require __DIR__ . '/auth.php';
