<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // TODO: isi Validasi

        return true;

        $hotel_code = $request->input('hotel_code');
        $room_type_code = $request->input('room_type_code');
        $lowest_price = $request->input('lowest_price');

        // Cek apakah room type tersedia
        $result = Rooms::where('room_types_code', '=', $room_type_code)
            ->where('hotel_code', '=', $hotel_code)
            ->where('status', '=', 0)
            ->where('price', '=', $lowest_price)
            ->firstOrFail();

        if ($result == null) {
            return response()->json([
                'message' => 'Room is no longer available',
            ], 404);
        }

        try {

            $result->status = 1;
            $result->save();

            return response()->json([
                'message' => 'Reservation success',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 404);
        }
    }

    public function getBookingPage(Request $request)
    {
    }
}
