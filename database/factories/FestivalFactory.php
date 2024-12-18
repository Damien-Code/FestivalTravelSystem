<?php

namespace Database\Factories;

use App\Models\Festival;
use App\Models\Festival_info;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Festival>
 */
class FestivalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'info_festival_id' => Festival_info::inRandomOrder()->first(),
            'date' => $this->faker->date(),
        ];
    }
}
