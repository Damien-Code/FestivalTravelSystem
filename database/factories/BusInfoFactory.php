<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BusInfo>
 */
class BusInfoFactory extends Factory
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
            'license_plate' => $this->faker->unique()->bothify('######'),
        ];
    }
}
