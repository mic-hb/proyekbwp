<?php

namespace Database\Seeders;

use App\Models\Rooms;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomsSeeder extends Seeder
{
    protected $model = Rooms::class;
    protected $connection = 'db_hotel_connection';
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 10; $i++) {
            Rooms::factory()->create();
        }

        Rooms::create([
            'code' => 'R011',
            'hotel_code' => 'H001',
            'room_types_code' => 'DLX',
            'floor' => '01',
            'number' => '01',
            'status' => 0,
            'price' => 300000,
        ]);
    }
}
