<?php

namespace App\Http\Controllers;

use App\Models\Hotels;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MainController extends Controller
{
    public function getHomePage(Request $request)
    {
        // List beberapa hotel yang muncul di cards/carousel
        $listHotels = Hotels::all();
        dump($listHotels);

        // Semamcam list penawaran kamar terbaru
        $listRooms = Rooms::all();
        dump($listRooms);

        dd('TESTING');

        return Inertia::render('index', [
            'listHotels' => $listHotels,
        ]);
    }

    public function getHotelsPage(Request $request)
    {
        // List hotel di card juga, tapi lebih lengkap
        $listHotels = Hotels::all();
        dump($listHotels);

        dd('TESTING');

        return Inertia::render('hotels', [
            'listHotels' => $listHotels,
        ]);
    }

    public function getHotelDetailPage(Request $request, string $hotel_code)
    {
        // Hotel sesuai param $hotel_code
        $hotel = Hotels::where('code', '=', $hotel_code)->first();
        dump($hotel);

        // List kamar di hotel itu, nanti di munculin semua pake cards
        // Yang di list jenis nya, bukan spesifik per nomor kamar
        $listRooms = $hotel->Rooms
            ->groupBy('room_type_code')
            ->map(function ($item, $key) {
                return $item->first();
            });
        dump($listRooms);

        dd('TESTING');

        return Inertia::render('hotel', [
            'hotel' => $hotel,
            'listRooms' => $listRooms,
        ]);
    }

    public function getRoomDetailPage(Request $request, string $hotel_code, string $room_type_code)
    {
        // Hotel sesuai param $hotel_code
        $hotel = Hotels::where('code', '=', $hotel_code)->first();
        dump($hotel);

        // List kamar di hotel itu, nanti di munculin semua pake cards
        $listRooms = $hotel->Rooms;
        dump($listRooms);

        dd('TESTING');

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
