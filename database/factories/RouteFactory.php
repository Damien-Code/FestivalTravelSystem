<?php

namespace Database\Factories;

use App\Models\Festival;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Route>
 */
class RouteFactory extends Factory
{
    /**
     * @author Brighton van Rouendal + Mischa Sasse
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $festival = Festival::inRandomOrder()->first() ?? Festival::factory()->create();
        return [
            'festival_id' => $festival->id,
            'location_id' => Location::factory(),
            'departure_time' => Carbon::parse($festival->date)->subMinutes(rand(5, 300)),
            'price' => $this->faker->numberBetween(2.5,12.5),
        ];
    }
}
