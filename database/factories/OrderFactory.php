<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tokens_used' => $this->faker->numberBetween(0,100) < 50 ? 0 : 100,
            'final_price' => $this->faker->numberBetween(0,100),
            'amount_of_tickets' => $this->faker->numberBetween(0,5),
        ];
    }
}
