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
        Rooms::factory(10)->create();
    }
}
