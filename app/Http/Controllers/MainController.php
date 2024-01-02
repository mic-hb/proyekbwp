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

<<<<<<< Updated upstream
    public function getHotelDetailPage(Request $request)
    {
        return Inertia::render('hotel');
=======
    public function getTopHotelsByFavorites(){
        try {
            $result = Hotels::select('hotels.*', DB::raw('COUNT(hotels.code) as favorite_count'))
            ->join('favorites', 'favorites.hotel_code', '=', 'hotels.code')
            ->groupBy('hotels.code')
            ->get();

            // 

            return response()->json($result, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error',
            ], 404);
        }
>>>>>>> Stashed changes
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
