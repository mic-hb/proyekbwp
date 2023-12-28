<?php

namespace Database\Factories;

use App\Models\Bookings;
use App\Models\Dtrans_hotel;
use App\Models\Htrans_hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dtrans_hotel>
 */
class Dtrans_hotelFactory extends Factory
{
    protected $model = Dtrans_hotel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $numericId = $this->faker->unique()->numberBetween(1,10);
        $formattedId = 'DT' . str_pad($numericId, 3, '0', STR_PAD_LEFT);

        $randomHtrans = Htrans_hotel::inRandomOrder()->first();
        $randomBookings = Bookings::inRandomOrder()->first();
        $randomSubtotal = $this->faker->unique()->numberBetween(1,99999);
        return [
            'id' => $formattedId,
            'htrans_id' => $randomHtrans,
            'booking_id' => $randomBookings,
            'subtotal' => $randomSubtotal,
        ];
    }
}
