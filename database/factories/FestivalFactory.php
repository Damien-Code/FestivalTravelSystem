<?php

namespace Database\Factories;

use App\Models\Festival;
use App\Models\FestivalInfo;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Festival>
 */
class FestivalFactory extends Factory
{
    /**
     * @author Brighton van Rouendal
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'info_festival_id' => FestivalInfo::inRandomOrder()->first(),
            'location_id' => Location::inRandomOrder()->first() ?? Location::factory()->create(),
            'date' => $this->faker->dateTimeBetween('now', '+1 years')->format('Y-m-d'),
        ];
    }
}
