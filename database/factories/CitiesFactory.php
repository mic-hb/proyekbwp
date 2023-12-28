<?php

namespace Database\Factories;

use App\Models\Cities;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cities>
 */
class CitiesFactory extends Factory
{
    protected $model = Cities::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $numericId = $this->faker->unique()->numberBetween(1, 999); // Generate a unique random number between 1 and 999

        // Format the numeric ID with leading zeros
        $formattedId = 'C' . str_pad($numericId, 3, '0', STR_PAD_LEFT);

        return [
            'code' => $formattedId,
            'name' => $this->faker->city(),
        ];
    }
}
