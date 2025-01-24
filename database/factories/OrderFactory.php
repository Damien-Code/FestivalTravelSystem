<?php

namespace Database\Factories;

use App\Models\Route;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
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
            'user_id' => User::inRandomOrder()->first(),
            'route_id' => Route::inRandomOrder()->first(),
            'tokens_used' => $this->faker->numberBetween(0,100) < 50 ? 0 : 100,
            'final_price' => $this->faker->numberBetween(0,100),
            'amount_of_tickets' => $this->faker->numberBetween(0,5),
        ];
    }
}
