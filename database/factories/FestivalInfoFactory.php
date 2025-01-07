<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FestivalInfo>
 */
class FestivalInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(2, true),
            'description' => $this->faker->paragraph(),
            // Image will be stored as URL for factories
            // Images will be stored as BLOBs for admin
            'image' => $this->faker->imageUrl(),
        ];
    }
}
