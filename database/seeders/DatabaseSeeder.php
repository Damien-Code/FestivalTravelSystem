<?php

namespace Database\Seeders;

use App\Models\Bus_in_use;
use App\Models\Bus_info;
use App\Models\Festival;
use App\Models\Festival_info;
use App\Models\Location;
use App\Models\Order;
use App\Models\Route;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        User::factory()->create([
            'name' => 'Brighton',
            'email' => 'brighton@vanrouendal.nl',
            'role_id' => '1'
        ]);
        Location::factory(100)->create();
        Festival_info::factory(100)->create();
        Festival::factory(100)->create();
        Route::factory(100)
            ->has(
                Bus_in_use::factory(rand(1, 3))
                    ->has(Bus_info::factory()->create())
                    ->has(User::factory()->create(['role_id' => 3]))
            )
            ->create();
        User::factory(100)
            ->has(Order::factory(rand(1,3))->create())
            ->create();
    }
}
