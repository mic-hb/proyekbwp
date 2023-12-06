<?php

use App\Http\Controllers\HotelController;
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

/**
 *  Route untuk halaman-halaman utama, cth: home, halaman hotel, halaman kamar, dll.
 */
Route::controller(MainController::class, 'getHomePage')->group(function () {
    Route::get('/', 'getHomePage')->name('home-page');
    Route::get('/hotels', 'getHotelsPage')->name('hotels-page');                                        // list hotel yang ada
    Route::get('/hotels/{hotel_code}', 'getHotelDetailPage')->name('hotel-detail-page');                // detail hotel
    Route::get('/hotels/{hotel_code}/{room_code}', 'getRoomDetailPage')->name('room-detail-page');      // detail kamar

    // TODO 1: kombinasi untuk booking di-hash atau di-random menjadi token (hotel_code, room_code, user_id)
    // TODO 2: simpan ke session atau sebagai booking_id (hanya semacam token sementara)
    // TODO 3: redirect ke halaman booking sesuai dengan id hotel & id kamar yang dipilih
    // TODO 4: tampilkan data booking berdasarkan booking_id atau token yang di-hash/di-random tadi (harus bisa di decode/un-hash)
    Route::post('hotels/{hotel_code}/{room_code}/setup', 'postSetupBooking')->name('setup-booking');    // proses data mengenai hotel & kamar yang di booking, redirect ke halaman booking
});

/**
 *  Route untuk halaman-halaman yang berhubungan dengan user, cth: login, register, logout, dll.
 */
Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'getLoginPage')->name('login-page');
    Route::get('/logout', 'getLogout')->name('logout');
    Route::get('/register', 'getRegisterPage')->name('register-page');

    Route::post('/login', 'postLogin')->name('login');
    Route::post('/register', 'postRegister')->name('register');
});

/**
 *  Route untuk halaman-halaman yang berhubungan dengan hotel, cth: booking hotel, detail booking, dll.
 */
Route::controller(HotelController::class)->group(function () {
    Route::get('hotels/book/{booking_token}', 'getBookingProcessPage')->name('book-hotel-page');    // halaman booking, user mengisi data diri, tanggal, dll.
    Route::post('hotels/book', 'postBookingProcess')->name('book-hotel');                           // proses transaction booking, simpan ke database (termasuk dtrans htrans)

    // TODO 5: tampilkan data booking berdasarkan booking_id yang sesungguhnya di database
    Route::get('{user_username}/{booking_id}', 'getBookingPage')->name('booking-page');             // detail booking (hanya bisa diakses user yang login)
});
