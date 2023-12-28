<?php

namespace App\Http\Controllers;

use App\Models\Hotels;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MainController extends Controller
{
    public function getHomePage(Request $request)
    {
        // $listHotels = Hotels::all();

        return Inertia::render('index');
        // return view('welcome');
    }

    public function getHotelsPage(Request $request)
    {
        return Inertia::render('hotels');
    }

    public function getHotelDetailPage(Request $request)
    {
        return Inertia::render('hotel');
    }

    public function getRoomDetailPage(Request $request)
    {
        return Inertia::render('room');
    }

    public function postSetupBooking(Request $request)
    {
        return redirect()->route('book-hotel-page', [
            'hotel_code' => $request->input('hotel_code'),
            'room_code' => $request->input('room_code')
        ]);
    }
}
