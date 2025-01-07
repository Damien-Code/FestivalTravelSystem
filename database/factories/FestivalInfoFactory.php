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
//            'image' => 'https://source.unsplash.com/random/800x800',
            'image' => $this->faker->imageUrl(),
            // image not yet added since we may need to check how to do those (blobs arent a faker thing)
        ];
    }
}
