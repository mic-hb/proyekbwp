<?php

namespace Database\Factories;

use App\Models\Cities;
use App\Models\Hotels;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotels>
 */
class HotelsFactory extends Factory
{
    protected $model = Hotels::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $numericId = $this->faker->unique()->numberBetween(1, 10);
        $formattedId ='H' . str_pad($numericId, 3, '0', STR_PAD_LEFT);

        $randomCity = Cities::inRandomOrder()->first();
        return [
            'code' => $formattedId,
            'city_code' => $randomCity->code,
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'status' => null,
        ];
    }
}
