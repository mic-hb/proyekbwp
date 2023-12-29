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

        // Semacam list penawaran kamar terbaru
        $roomsToBeShown = 5;
        $listRooms = Rooms::all()
            ->sortByDesc('created_at')
            ->take($roomsToBeShown);

        // Nambahin data hotel ke masing-masing data kamar
        foreach ($listRooms as $room_code => $room) {
            $listRooms[$room_code]['hotel'] = $room->Hotel;
        }

        $arrayToBeSent = [
            'listHotels' => $listHotels,
            'listRooms' => $listRooms,
        ];

        $arrayToBeSent = json_decode(json_encode($arrayToBeSent));

        if($request->wantsJson()) {
            // Coba return json object ke Postman
            return $arrayToBeSent;
        }else{
            return Inertia::render('index', $arrayToBeSent);
        }

        return view('home');
    }

    public function getHotelsPage(Request $request)
    {
        // List hotel di card juga, tapi lebih lengkap
        $listHotels = Hotels::all();

        $arrayToBeSent = [
            'listHotels' => $listHotels,
        ];

        $arrayToBeSent = json_decode(json_encode($arrayToBeSent));

        if($request->wantsJson()) {
            // Coba return json object ke Postman
            return $arrayToBeSent;
        }else{
            return Inertia::render('hotels', $arrayToBeSent);
        }
    }

    public function getHotelDetailPage(Request $request, string $hotel_code)
    {
        // Hotel sesuai param $hotel_code
        $hotel = Hotels::where('code', '=', $hotel_code)->first();

        // List kamar di hotel itu, nanti di munculin semua pake cards
        // Yang di list jenis nya, bukan spesifik per nomor kamar
        $listTypes = $hotel->Rooms->groupBy('type');

        foreach ($listTypes as $type => $rooms) {
            $listRoomsByType[$type] = $rooms[0];
        }

        // List kamar dgn harga berbeda-beda
        $listPrices = $hotel->Rooms
            ->groupBy('price');

        foreach ($listPrices as $price => $rooms) {
            $listRoomsByPrice[$price] = $rooms[0];
        }

        $arrayToBeSent = [
            'hotel' => $hotel,
            'listRoomsByType' => $listRoomsByType,
            'listRoomsByPrice' => $listRoomsByPrice,
        ];

        $arrayToBeSent = json_decode(json_encode($arrayToBeSent));

        if($request->wantsJson()) {
            // Coba return json object ke Postman
            return $arrayToBeSent;
        }else{
            return Inertia::render('hotel', $arrayToBeSent);
        }
    }

    public function getRoomDetailPage(Request $request, string $hotel_code, string $room_type_code)
    {
        // Hotel sesuai param $hotel_code
        $hotel = Hotels::where('code', '=', $hotel_code)->first();

        // List kamar di hotel itu, nanti di munculin semua pake cards
        $listRooms = $hotel->Rooms;

        $arrayToBeSent = [
            'hotel' => $hotel,
            'listRooms' => $listRooms,
        ];

        $arrayToBeSent = json_decode(json_encode($arrayToBeSent));

        if($request->wantsJson()) {
            // Coba return json object ke Postman
            return $arrayToBeSent;
        }else{
            return Inertia::render('room', $arrayToBeSent);
        }
    }

    public function postSetupBooking(Request $request)
    {
        return redirect()->route('book-hotel-page', [
            'hotel_code' => $request->input('hotel_code'),
            'room_code' => $request->input('room_code')
        ]);
    }
}
