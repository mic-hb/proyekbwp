<?php

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Testing API
Route::get('/test', function () {
    return response()->json([
        'message' => 'Hello World!',
    ], 200);
});

Route::controller(MainController::class)->group(function () {
    Route::get('/allHotels', 'getAllHotels');
    Route::get('/hotel/{id}', 'getHotelById');
    Route::get('/hotel/{id}/rooms', 'getRoomsByHotelCode');
    Route::get('/topFavorites', 'getTopHotelsByFavorites');
    Route::get('/topReviews', 'getTopHotelsByReviews');
    Route::get('/randomHotels', 'getRandomHotels');
});
