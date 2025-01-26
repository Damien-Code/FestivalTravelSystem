<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * @author Brighton van Rouendal + Mischa Sasse
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'country' => $this->faker->countryCode(),
            'city' => $this->faker->city(),
            'street' => $this->faker->streetName(),
        ];
    }
}
