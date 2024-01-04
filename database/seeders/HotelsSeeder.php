<?php

namespace Database\Seeders;

use App\Models\Hotels;
use App\Models\Images_hotels;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelsSeeder extends Seeder
{
    protected $model = Hotels::class;
    protected $connection = 'db_hotel_connection';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Hotels::factory()->create();
        }

        $listHotels = Hotels::all();
        // foreach ($listHotels as $hotel) {
        //     $hotel->Rooms()->createMany(
        //         RoomsSeeder::generateRooms($hotel->code)
        //     );
        // }

        $code = 1;
        foreach ($listHotels as $hotel) {
            $formattedCode = 'IH' . str_pad($code, 3, '0', STR_PAD_LEFT);

            Images_hotels::create([
                'code' => $formattedCode,
                'hotel_code' => $hotel->code,
                'url' => 'https://picsum.photos/seed/' . $hotel->code . '/200/300',
            ]);

            $code++;
        }

        Images_hotels::create([
            'code' => 'IH011',
            'hotel_code' => 'H001',
        ]);
    }
}
