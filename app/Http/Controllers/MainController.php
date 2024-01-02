<?php

namespace App\Http\Controllers;

use App\Models\Hotels;
use App\Models\Images_hotels;
use App\Models\Images_rooms;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MainController extends Controller
{
    public function getAllHotels(Request $request)
    {
        try {
            $take = $request->query('take');
            $skip = $request->query('skip');

            // $result = Hotels::select('code', 'name', 'address')
            //     ->with('Images')
            //     ->take($take)
            //     ->skip($skip)
            //     ->get();

            $result = Hotels::select('hotels.*')
                ->with('City')
                ->addSelect(DB::raw('(SELECT JSON_ARRAYAGG(images.url) FROM images_hotels AS images WHERE images.hotel_code = hotels.code) as image_urls'))
                ->addSelect(DB::raw('(SELECT cities.name FROM cities WHERE cities.code = hotels.city_code) as city_name'))
                ->take($take)
                ->skip($skip)
                ->get();

            return response()->json(
                $result,
                200
            );
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 404);
        }
    }

    public function getHotelById(string $id)
    {
        try {
            $result = Hotels::select('hotels.*', DB::raw('COUNT(hotels.code) as favorite_count'))
                ->join('favorites', 'favorites.hotel_code', '=', 'hotels.code')
                ->groupBy('hotels.code')
                ->get();

            $result = Hotels::select('hotels.*')
                ->where('code', '=', $id)
                // ->with('City')
                // ->with('Images')
                ->addSelect(DB::raw('(SELECT JSON_ARRAYAGG(images.url) FROM images_hotels AS images WHERE images.hotel_code = hotels.code) as image_urls'))
                ->addSelect(DB::raw('(SELECT cities.name FROM cities WHERE cities.code = hotels.city_code) as city_name'))
                ->addSelect(DB::raw('COUNT(hotels.code) as review_count'), DB::raw('AVG(reviews.stars) as average_rating'))
                ->join('reviews', 'reviews.hotel_code', '=', 'hotels.code')
                // ->addSelect(DB::raw('COUNT(hotels.code) as favorite_count'))
                // ->join('favorites', 'favorites.hotel_code', '=', 'hotels.code')
                ->addSelect(DB::raw('(SELECT COUNT(favorites.hotel_code) FROM favorites WHERE favorites.hotel_code = hotels.code) as favorite_count'))
                ->groupBy('hotels.code')
                ->orderBy('average_rating', 'DESC')
                ->get();

            return response()->json($result, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 404);
        }
    }

    public function getTopHotelsByFavorites()
    {
        try {
            $result = Hotels::select('hotels.*', DB::raw('COUNT(hotels.code) as favorite_count'))
                ->join('favorites', 'favorites.hotel_code', '=', 'hotels.code')
                ->groupBy('hotels.code')
                ->get();

            return response()->json($result, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 404);
        }
    }

    public function getTopHotelsByReviews()
    {
        try {
            $result = Hotels::select('hotels.*', DB::raw('COUNT(hotels.code) as review_count'), DB::raw('AVG(reviews.stars) as average_rating'))
                ->join('reviews', 'reviews.hotel_code', '=', 'hotels.code')
                ->groupBy('hotels.code')
                ->orderBy('average_rating', 'DESC')
                ->get();

            return response()->json($result, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 404);
        }
    }

    public function getRandomHotels(int $take, int $skip)
    {
        // List beberapa hotel yang muncul di cards/carousel secara RANDOM
        $listHotels = Hotels::select('code', 'name', 'address', 'city_code')
            ->inRandomOrder()
            ->take($$take)
            ->skip($skip)
            ->get();
        // ->makeHidden(['code', 'city_code', 'status', 'created_at', 'updated_at', 'deleted_at']);

        foreach ($listHotels as $idx => $hotel) {
            $images = Images_hotels::where('hotel_code', '=', $hotel->code)
                ->get();

            $image_url = [];
            foreach ($images as $image) {
                $image_url[] = $image->url;
            }

            $listHotels[$idx]['img'] = $image_url;
            $listHotels[$idx]['city_name'] = $hotel->City->name;
            $listHotels[$idx]['lowest_price'] = null;
            unset($listHotels[$idx]['City']);
        }

        return response()->json($listHotels);
    }

    public function getRoomsByHotelCode(string $id)
    {
        try {
            // $result = Hotels::findOrFail($id)
            //     ->Rooms
            //     ->groupBy('room_types_code');

            $result = Hotels::findOrFail($id)
                ->Rooms()
                ->with('Images') // Include the Images relationship
                ->get()
                ->groupBy('room_types_code');

            return response()->json($result, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Hotel not found',
            ], 404);
        }
    }

    public function getRandomRooms()
    {
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
    }

    public function postSetupBooking(Request $request)
    {
        return redirect()->route('book-hotel-page', [
            'hotel_code' => $request->input('hotel_code'),
            'room_code' => $request->input('room_code')
        ]);
    }
}
