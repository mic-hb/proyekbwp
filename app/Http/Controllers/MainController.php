<?php

namespace App\Http\Controllers;

use App\Models\Hotels;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function getHomePage(Request $request)
    {
        $listHotels = Hotels::all();

        return view('user.home');
        // return view('welcome');
    }

    public function getHotelsPage(Request $request)
    {
        return view('hotels');
    }

    public function getHotelDetailPage(Request $request)
    {
        return view('hotel');
    }

    public function getRoomDetailPage(Request $request)
    {
        return view('room');
    }

    public function postSetupBooking(Request $request)
    {
        return redirect()->route('book-hotel-page', [
            'hotel_code' => $request->input('hotel_code'),
            'room_code' => $request->input('room_code')
        ]);
    }
}
