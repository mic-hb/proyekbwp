<?php

namespace Database\Seeders;

use App\Models\Hotels;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelsSeeder extends Seeder
{
    protected $model =Hotels::class;
    protected $connection ='db_hotel_connection';
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hotels::factory(10)->create();
    }
}
