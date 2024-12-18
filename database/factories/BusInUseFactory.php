<?php

namespace Database\Factories;

use App\Models\Bus_info;
use App\Models\Route;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bus_in_use>
 */
class BusInUseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'bus_info_id' => Bus_info::inRandomOrder()->first(),
            'route_id' => Route::inRandomOrder()->first(),
            'user_id' => User::inRandomOrder()->first(),
        ];
    }
}
