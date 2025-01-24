<?php

namespace Database\Factories;

use App\Models\BusInfo;
use App\Models\Route;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BusInUse>
 */
class BusInUseFactory extends Factory
{
    /**
     * @author Brighton van Rouendal
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'bus_id' => BusInfo::inRandomOrder()->first(),
            'route_id' => Route::inRandomOrder()->first(),
            'user_id' => User::where('role_id', 3)->inRandomOrder()->first(),
        ];
    }
}
