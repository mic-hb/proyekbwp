<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Dtrans_hotel;
use App\Models\Htrans_hotel;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    public function getBookingData(Request $request)
    {
        if (Session::has('booking_data')) {
            return response()->json([
                'status' => (bool)true,
                'data' => Session::get('booking_data'),
            ], 200);
        } else {
            return response()->json([
                'status' => (bool)false,
                'message' => 'You have no pending booking data',
            ], 404);
        }
    }

    public function getCancelBooking(Request $request)
    {
        if (Session::has('booking_data')) {
            Session::forget('booking_data');

            return response()->json([
                'status' => (bool)true,
                'message' => 'Your booking has been cancelled',
            ], 200);
        } else {
            return response()->json([
                'status' => (bool)false,
                'message' => 'You have no pending booking data',
            ], 404);
        }
    }

    public function postConfirmBooking(Request $request)
    {
        try {
            $user_id = $request->user_id;
            $hotel_code = $request->hotel_code;
            $room_code = $request->room_code;
            $room_type_code = $request->room_type_code;
            $lowest_price = $request->lowest_price;
            $start_date = $request->start_date;
            $end_date = $request->end_date;

            // Cek apakah room type tersedia
            $room = Rooms::where('code', '=', $room_code)
                ->where('hotel_code', '=', $hotel_code)
                ->where('room_types_code', '=', $room_type_code)
                ->where('price', '=', $lowest_price)
                ->where('status', '=', 0)
                ->firstOrFail();

            if ($room == null) {
                return response()->json([
                    'message' => 'Room is no longer available',
                ], 404);
            }

            $room->status = 1;

            $booking_id = 'B' . str_pad((DB::connection('db_hotel_connection')->table('bookings')->count() + 1), 3, '0', STR_PAD_LEFT);
            $result = Bookings::create([
                'id' => $booking_id,
                'room_code' => $room->code,
                'user_id' => $user_id,
                'start_date' => $start_date,
                'end_date' => $end_date,
            ]);

            $htrans_id = 'HT' . str_pad((DB::connection('db_hotel_connection')->table('htrans_hotel')->count() + 1), 3, '0', STR_PAD_LEFT);
            $result = Htrans_hotel::create([
                'id' => $htrans_id,
                'user_id' => $user_id,
                'date' => now(),
                'total' => $lowest_price,
            ]);

            $result = Dtrans_hotel::create([
                'id' => 'DT' . str_pad((DB::connection('db_hotel_connection')->table('dtrans_hotel')->count() + 1), 3, '0', STR_PAD_LEFT),
                'htrans_id' => $htrans_id,
                'booking_id' => $booking_id,
                'subtotal' => $lowest_price,
            ]);

            $room->save();
            Session::forget('booking_data');

            return response()->json([
                'status' => (bool)true,
                'message' => 'Success!',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => (bool)false,
                'message' => $th->getMessage(),
            ], 501);
        }
    }

    public function postSetupBooking(Request $request)
    {
        try {
            // TODO: isi Validasi


            $hotel_code = $request->hotel_code;
            $room_type_code = $request->room_type_code;
            $lowest_price = $request->lowest_price;

            // Cek apakah room type tersedia
            $room = Rooms::where('room_types_code', '=', $room_type_code)
                ->where('hotel_code', '=', $hotel_code)
                ->where('status', '=', 0)
                ->where('price', '=', $lowest_price)
                ->firstOrFail();

            if ($room == null) {
                return response()->json([
                    'message' => 'Room is no longer available',
                ], 404);
            }

            $room_code = $room->code;

            if (Session::has('booking_data')) {
                return response()->json([
                    'status' => (bool)false,
                    'message' => 'You already have a booking'
                ]);
            }

            // TODO: Pass data to frontend

            Session::put('booking_data', [
                'hotelCode' => $hotel_code,
                'roomTypeCode' => $room_type_code,
                'roomCode' => $room_code,
                'lowestPrice' => $lowest_price,
            ]);

            return response()->json([
                'status' => (bool)true,
                'message' => 'Please confirm your booking!',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => (bool)false,
                'message' => $th->getMessage(),
            ], 501);
        }
    }

    public function getBookingPage(Request $request)
    {
    }
}
