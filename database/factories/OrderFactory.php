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
        $route = Route::inRandomOrder()->first() ?? Route::factory()->create();
        $tickets = $this->faker->numberBetween(1, 35);
        return [
            'user_id' => User::inRandomOrder()->first(),
            'route_id' => $route->id,
            'tokens_used' => $this->faker->numberBetween(0,100) < 50 ? 0 : 100,
            'final_price' => $route->price * $tickets,
            'amount_of_tickets' => $this->faker->numberBetween(0,5),
        ];
    }
}
