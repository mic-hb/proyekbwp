<?php

use App\Http\Controllers\EntryContoller;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return redirect()->route('login-page');
});

Route::controller(EntryContoller::class)->group(function () {
    Route::get('/login', 'getLoginPage')->name('login-page');
    Route::get('/register', 'getRegisterPage')->name('register-page');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'getHomePage')->name('home-page');
});
