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
        // List beberapa hotel yang muncul di cards/carousel secara RANDOM
        $hotelsToBeShown = 5;
        $listHotels = Hotels::inRandomOrder()
            ->take($hotelsToBeShown)
            ->get();
        dump($listHotels);

        // Semamcam list penawaran kamar terbaru
        $roomsToBeShown = 5;
        $listRooms = Rooms::all()
            ->sortByDesc('created_at')
            ->take($roomsToBeShown);
        dump($listRooms);

        foreach ($listRooms as $room_code => $room) {
            $listRooms[$room_code]['hotel'] = $room->Hotel;
        }

        $listRooms = json_encode($listRooms);
        dump($listRooms);
        dump(json_decode($listRooms));

        dd('END OF TESTING');

        return Inertia::render('index', [
            'listHotels' => $listHotels,
            'listRooms' => $listRooms,
        ]);
    }

    public function getHotelsPage(Request $request)
    {
        // List hotel di card juga, tapi lebih lengkap
        $listHotels = Hotels::all();
        dump($listHotels);

        dd('END OF TESTING');

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
        $listTypes = $hotel->Rooms
            ->groupBy('type');
        dump($listTypes);

        foreach ($listTypes as $type => $rooms) {
            $listRoomsByType[$type] = $rooms[0];
        }
        dump($listRoomsByType);

        // List kamar dgn harga berbeda-beda
        $listPrices = $hotel->Rooms
            ->groupBy('price');
        dump($listPrices);

        foreach ($listPrices as $price => $rooms) {
            $listRoomsByPrice[$price] = $rooms[0];
        }
        dump($listRoomsByPrice);

        dd('END OF TESTING');

        return Inertia::render('hotel', [
            'hotel' => $hotel,
            'listRoomsByType' => $listRoomsByType,
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

        dd('END OF TESTING');

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
