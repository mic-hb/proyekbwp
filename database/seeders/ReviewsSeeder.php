<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsSeeder extends Seeder
{
    protected $connection = 'db_hotel_connection';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listUsers = \App\Models\Users::all();
        $listHotels = \App\Models\Hotels::all();

        $ctr = 1;
        foreach ($listUsers as $user) {
            if ($user->id != 'U000') {
                $listHotels->random(5)->each(function ($hotel) use ($user) {
                    $user->Reviews()
                        ->attach(
                            $hotel->code,
                            [
                                'id' => 'RE' . str_pad((DB::connection('db_hotel_connection')->table('reviews')->count() + 1), 3, '0', STR_PAD_LEFT),
                                'stars' => rand(1, 5),
                                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam euismod, nisl eget aliquam ultricies, nunc nisl ult',
                            ],
                        );
                });
            }
        }

        // DB::raw('INSERT INTO reviews (id, user_id, hotel_code, stars) VALUES ("RE001", "U001", "H001", 4)');
        // DB::raw('INSERT INTO reviews (id, user_id, hotel_code, stars) VALUES ("RE002", "U002", "H001", 5)');
    }
}
