<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoritesSeeder extends Seeder
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
                    $user->Favorites()
                        ->attach(
                            $hotel->code,
                            ['id' => 'F' . str_pad((DB::connection('db_hotel_connection')->table('favorites')->count() + 1), 3, '0', STR_PAD_LEFT)],
                        );
                });
            }
        }

        // DB::raw('INSERT INTO favorites (id, user_id, hotel_code) VALUES ("F001", "U001", "H001")');
        // DB::raw('INSERT INTO favorites (id, user_id, hotel_code) VALUES ("F002", "U001", "H002")');
        // DB::raw('INSERT INTO favorites (id, user_id, hotel_code) VALUES ("F003", "U002", "H001")');
    }
}
