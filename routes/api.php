<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
    try {
        // session(['key' => 'value']);
        // return session('key');
        Session::forget('booking_data');
        dd(session()->all());
        return Auth::user();

        return response()->json([
            'message' => 'Hello World!',
        ], 200);
    } catch (\Throwable $th) {
        return response()->json([
            'message' => $th->getMessage(),
        ], 404);
    }
});

Route::controller(MainController::class)->group(function () {
    Route::get('/allCities', 'getAllCities');
    Route::get('/allHotels', 'getAllHotels');
    Route::get('/hotel/{id}', 'getHotelById');
    Route::get('/hotel/{id}/rooms', 'getRoomsByHotelCode');
    Route::get('/topFavorites', 'getTopHotelsByFavorites');
    Route::get('/topReviews', 'getTopHotelsByReviews');
    Route::get('/randomHotels', 'getRandomHotels');
});

Route::controller(TransactionController::class)->group(function () {
    Route::get('/hotel/{id}/transactions', 'getTransactionData');
});

Route::get('/testpassword/', function (Request $request) {
    // Bikin password manual pake hashing bcrypt bawaan laravel
    // $password = '123';
    $password = 'admin';
    // $password = $request->password;

    // Hash the password
    $hashedPassword = bcrypt($password);

    return $hashedPassword;
});

/**
 *  Route untuk halaman-halaman utama, cth: home, halaman hotel, halaman kamar, dll.
 */
Route::controller(MainController::class, 'getHomePage')->group(function () {
    // Route::get('/', 'getHomePage')->name('home-page');
    // Route::get('/hotels', 'getHotelsPage')->name('hotels-page');                                            // list hotel yang ada
    // Route::get('/hotels/{hotel_code}', 'getHotelDetailPage')->name('hotel-detail-page');                    // detail hotel
    // Route::get('/hotels/{hotel_code}/{room_type_code}', 'getRoomDetailPage')->name('room-detail-page');     // detail jenis kamar

    // TODO: 1. kombinasi untuk booking di-hash atau di-random menjadi token (hotel_code, room_code, user_id)
    // TODO: 2. simpan ke session atau sebagai booking_id (hanya semacam token sementara)
    // TODO: 3. redirect ke halaman booking sesuai dengan id hotel & id kamar yang dipilih
    // TODO: 4. tampilkan data booking berdasarkan booking_id atau token yang di-hash/di-random tadi (harus bisa di decode/un-hash)
    // Route::post('hotels/{hotel_code}/{room_type_code}/setup', 'postSetupBooking')->name('setup-booking');    // proses data mengenai hotel & kamar yang di booking, redirect ke halaman booking
});


/**
 *  Route untuk halaman-halaman yang berhubungan dengan hotel, cth: booking hotel, detail booking, dll.
 */
Route::controller(BookingController::class)->group(function () {
    Route::middleware('api', 'CekRole:1')->group(function () {
        Route::post('/bookings/setup', 'postSetupBooking')->name('setup-booking');                             // proses data mengenai hotel & kamar yang di booking, redirect ke halaman booking
        Route::post('/bookings/confirm', 'postConfirmBooking')->name('confirm-booking');                             // proses data mengenai hotel & kamar yang di booking, redirect ke halaman booking
        Route::get('/bookings/data', 'getBookingData')->name('booking-data');                             // proses data mengenai hotel & kamar yang di booking, redirect ke halaman booking
        Route::get('/bookings/cancel', 'getCancelBooking')->name('cancel-booking');                             // proses data mengenai hotel & kamar yang di booking, redirect ke halaman booking
    });

    // Route::get('hotels/book/{booking_token}', 'getBookingProcessPage')->name('book-hotel-page');            // halaman booking, user mengisi data diri, tanggal, dll.
    // Route::post('hotels/book', 'postBookingProcess')->name('book-hotel');                                   // proses transaction booking, simpan ke database (termasuk dtrans htrans)

    // // TODO: 5. tampilkan data booking berdasarkan booking_id yang sesungguhnya di database
    // Route::get('{user_username}/{booking_id}', 'getBookingPage')->name('booking-page');                     // detail booking (hanya bisa diakses user yang login)
});


/**
 *  Route untuk halaman-halaman yang berhubungan dengan user, cth: login, register, logout, dll.
 */
Route::controller(UserController::class)->group(function () {
    Route::get('/profile', 'getProfilePage')->name('profile-page')->middleware(['CekRole:1']);                               // data user + list favorite & review

    // Route::get('/logout', 'getLogout')->name('logout');
    Route::post('/postLogin', 'postLogin')->name('login');
    Route::post('/postRegister', 'postRegister')->name('register');

    Route::get('/checkLogin', 'checkLogin')->name('checkLogin');
});


/**
 *  Route untuk admin
 */
Route::controller(AdminController::class)->group(function () {
    Route::middleware(['CekRole:0'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::post('/proses', 'doProses')->name('doProses');
            Route::post('/delete', 'doDelete')->name('doDelete');
        });
    });
});


/**
 *  Route untuk manager hotel / seller
 */
Route::controller(ManagerController::class)->group(function () {
    Route::middleware(['CekRole:2'])->group(function () {
        Route::get('/manager', 'getDashboardPage')->name('dashboard-page');
    });
});


// Route::inertia('/', 'index');

// Route::get('/', function () {
//     return Inertia::render('index', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//         'namaKita' => "Budi",
//     ]);
// });
