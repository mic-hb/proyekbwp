<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function getBookingProcessPage(Request $request)
    {
    }

    public function postBookingProcess(Request $request)
    {
    }

    public function postSetupBooking(Request $request)
    {
        try {
            // TODO: isi Validasi


            $hotel_code = $request->input('hotel_code');
            $room_type_code = $request->input('room_type_code');
            $lowest_price = $request->input('lowest_price');

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

            $room->status = 1;

            $result = Bookings::create([
                'id' => 'B' . str_pad((DB::connection('db_hotel_connection')->table('bookings')->count() + 1), 3, '0', STR_PAD_LEFT),
                'room_code' => $room->code,
                'user_id' => Auth::guard('User')->user()->id,
                'start_date' => now(),
                'end_date' => now()->addDays(2),
                // 'start_date' => $request->input('start_date'),
                // 'end_date' => $request->input('end_date'),
            ]);

            $room->save();

            // TODO: Pass data to frontend

            if ($result) {
                return response()->json([
                    'message' => 'Reservation success',
                    'booking_id' => $result->id,
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 501);
        }
    }

    public function getBookingPage(Request $request)
    {
    }
}
