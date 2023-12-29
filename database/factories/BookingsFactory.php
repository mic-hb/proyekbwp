<?php

namespace Database\Factories;

use App\Models\Bookings;
use App\Models\Rooms;
use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bookings>
 */
class BookingsFactory extends Factory
{
    protected $model = Bookings::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $numericId = Bookings::count() + 1;
        $formattedId ='B' . str_pad($numericId, 3, '0', STR_PAD_LEFT);

        $randomRoom = Rooms::inRandomOrder()->first();
        $randomUser = Users::inRandomOrder()->first();
        return [
            'id' =>$formattedId,
            'room_code' => $randomRoom->code,
            'user_id' => $randomUser->id,
        ];
    }
}
