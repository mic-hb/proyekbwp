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
        DB::raw('INSERT INTO reviews (id, user_id, hotel_code, stars) VALUES ("RE001", "U001", "H001", 4)');
        DB::raw('INSERT INTO reviews (id, user_id, hotel_code, stars) VALUES ("RE002", "U002", "H001", 5)');
    }
}
