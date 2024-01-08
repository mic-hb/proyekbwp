<?php

namespace App\Http\Controllers;

use App\Models\Hotels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    public function getTransactionData(string $id)
    {
        try {
            $result = Hotels::select('hotels.*')
                ->where('code', '=', $id)
                ->with('UserReviews')
                ->addSelect(DB::raw('(SELECT JSON_ARRAYAGG(images.url) FROM images_hotels AS images WHERE images.hotel_code = hotels.code) as image_urls'))
                ->addSelect(DB::raw('(SELECT cities.name FROM cities WHERE cities.code = hotels.city_code) as city_name'))
                ->addSelect(DB::raw('(SELECT COUNT(favorites.hotel_code) FROM favorites WHERE favorites.hotel_code = hotels.code) as favorite_count'))
                ->addSelect(DB::raw('(SELECT COUNT(reviews.hotel_code) FROM reviews WHERE reviews.hotel_code = hotels.code) as review_count'))
                ->addSelect(DB::raw('(SELECT AVG(reviews.stars) FROM reviews WHERE reviews.hotel_code = hotels.code) as average_rating'))
                ->selectRaw('(
                    SELECT JSON_ARRAYAGG(JSON_OBJECT(
                        "id", htrans_hotel.id,
                        "user", (
                            SELECT JSON_OBJECT(
                                "id", users.id,
                                "name", users.name,
                                "email", users.email,
                                "phone", users.phone
                            )
                            FROM users WHERE users.id = htrans_hotel.user_id
                            LIMIT 1
                        ),
                        "details", (
                            SELECT JSON_ARRAYAGG(JSON_OBJECT(
                                "id", dtrans_hotel.id,
                                "user", users.name,
                                "roomType", room_types.name,
                                "startDate", bookings.start_date,
                                "endDate", bookings.end_date,
                                "subtotal", dtrans_hotel.subtotal
                            ))
                            FROM dtrans_hotel
                            JOIN bookings ON bookings.id = dtrans_hotel.booking_id
                            JOIN users ON users.id = bookings.user_id
                            JOIN rooms ON rooms.code = bookings.room_code
                            JOIN room_types ON room_types.code = rooms.room_types_code
                            WHERE dtrans_hotel.htrans_id = htrans_hotel.id
                        ),
                        "date", htrans_hotel.date,
                        "total", htrans_hotel.total))
                    FROM htrans_hotel
                    JOIN dtrans_hotel ON htrans_hotel.id = dtrans_hotel.htrans_id
                    JOIN bookings ON bookings.id = dtrans_hotel.booking_id
                    JOIN rooms ON rooms.code = bookings.room_code
                    WHERE rooms.hotel_code = hotels.code) as transactions
                ')
                ->get();

            return response()->json($result, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 404);
        }
    }
}
