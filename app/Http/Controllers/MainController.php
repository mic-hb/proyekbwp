<?php

namespace App\Http\Controllers;

use App\Models\Hotels;
use App\Models\Images_hotels;
use App\Models\Images_rooms;
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
            ->get()
            ->makeHidden(['code', 'city_code', 'status', 'created_at', 'updated_at', 'deleted_at']);

        foreach ($listHotels as $idx => $hotel) {
            $images = Images_hotels::where('hotel_code', '=', $hotel->code)
                ->get();

            // return $images;

            $image_url = [];
            foreach ($images as $image) {
                $image_url[] = $image->url;
            }

            $listHotels[$idx]['img'] = $image_url;
            $listHotels[$idx]['city_name'] = $hotel->City->name;
            $listHotels[$idx]['lowest_price'] = null;
            unset($listHotels[$idx]['City']);

            // return $listHotels[$idx]['city'];
        }

        // Semacam list penawaran kamar terbaru
        $roomsToBeShown = 5;
        $listRooms = Rooms::all()
            ->sortByDesc('created_at')
            ->take($roomsToBeShown)
            ->makeHidden(['code', 'hotel_code', 'floor', 'number', 'status', 'created_at', 'updated_at', 'deleted_at']);

        // Nambahin data hotel ke masing-masing data kamar
        foreach ($listRooms as $room_code => $room) {
            $images = Images_rooms::where('room_types_code', '=', $room->Type->code)
                ->get();

            // return $images;

            $image_url = [];
            foreach ($images as $image) {
                $image_url[] = $image->url;
            }

            $listRooms[$room_code]['img'] = $image_url;
            $listRooms[$room_code]['hotel'] = $room->Hotel
                ->makeHidden(['code', 'city_code', 'status', 'created_at', 'updated_at', 'deleted_at']);
            $listRooms[$room_code]['on_discount'] = (bool)random_int(0, 1);
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
