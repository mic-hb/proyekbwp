<?php

namespace Database\Seeders;

use App\Models\Bookings;
use App\Models\Dtrans_hotel;
use App\Models\Htrans_hotel;
use DateInterval;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TransactionSeeder extends Seeder
{
    protected $connection = 'db_hotel_connection';
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i <= 5; $i++) {
            $faker = Faker::create();
            $startDate = $faker->date('d/m/Y');
            $startDate = DateTime::createFromFormat('d/m/Y', $startDate);
            $endDate = $startDate->add(new DateInterval('P' . 3 . 'D'));
            Bookings::create([
                'id' => 'B00' . $i,
                'room_code' => 'R00' . $i,
                'user_id' => 'U001',
                'start_date' => $startDate,
                'end_date' => $endDate,
            ]);

            $total = Bookings::find('B001')->Room->price * 3;
            Htrans_hotel::create([
                'id' => 'HT00' . $i,
                'user_id' => 'U001',
                'date' => now(),
                'total' => $total,
            ]);

            Dtrans_hotel::create([
                'id' => 'DT00' . $i,
                'htrans_id' => 'HT00' . $i,
                'booking_id' => 'B00' . $i,
                'subtotal' => $total,
            ]);
        }
    }
}
