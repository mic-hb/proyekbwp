<?php

namespace Database\Factories;

use App\Models\Hotels;
use App\Models\Room_types;
use App\Models\Rooms;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rooms>
 */
class RoomsFactory extends Factory
{
    protected $model = Rooms::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $numericId = $this->faker->unique()->numberBetween(1,10);
        $formattedId = 'R' . str_pad($numericId, 3, '0', STR_PAD_LEFT);

        $randomHotel = Hotels::inRandomOrder()->first();
        $randomType = Room_types::inRandomOrder()->first();
        $randomFloor = $this->faker->numberBetween(1,50);
        $formattedFloor = str_pad($randomFloor, 2, '0', STR_PAD_LEFT);
        $randomNumber = $this->faker->numberBetween(1,20);
        $formattedNumber = str_pad($randomNumber, 2, '0', STR_PAD_LEFT);
        $randomPrice = $this->faker->numberBetween(300000,5000000);

        return [
            'code' => $formattedId,
            'hotel_code' => $randomHotel->code,
            'type' => $randomType->code,
            'floor' => $formattedFloor,
            'number' => $formattedNumber,
            'status' => 0,
            'price' => $randomPrice,
        ];
    }
}
