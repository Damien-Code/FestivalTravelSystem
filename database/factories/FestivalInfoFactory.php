<?php

namespace Database\Factories;

use App\Models\FestivalInfo;
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
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Smknstd\FakerPicsumImages\FakerPicsumImagesProvider($faker));
        return [
            'title' => $this->faker->words(2, true),
            'description' => $this->faker->paragraph(),
            // Image will be stored as URL for factories
            // Images will be stored as BLOBs for admin
            'image' => $faker->imageURL(),
        ];
    }
}
