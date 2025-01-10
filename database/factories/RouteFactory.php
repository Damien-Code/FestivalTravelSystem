<?php

namespace Database\Factories;

use App\Models\Festival;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Route>
 */
class RouteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'festival_id' => Festival::inRandomOrder()->first(),
            'location_id' => Location::factory(),
            'departure_time' => $this->faker->dateTimeBetween('-1 years', '+1 years'),
            'price' => $this->faker->numberBetween(2.5,12.5),
        ];
    }
}
