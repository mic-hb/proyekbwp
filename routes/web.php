<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
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

Route::redirect('home', '/', 301);

Route::controller(MainController::class, 'getHomePage')->group(function () {
    Route::get('/', 'getHomePage')->name('home-page');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'getLoginPage')->name('login-page');
    Route::post('/login', 'postLogin')->name('login');
    Route::get('/logout', 'getLogout')->name('logout');
    Route::get('/register', 'getRegisterPage')->name('register-page');
    Route::post('/register', 'postRegister')->name('register');
});
