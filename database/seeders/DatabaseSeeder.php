<?php

namespace Database\Seeders;

use App\Models\BusInUse;
use App\Models\BusInfo;
use App\Models\Festival;
use App\Models\FestivalInfo;
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
        User::factory(1)->create(['role_id' => 3]);
        Location::factory(1)->create();
        FestivalInfo::factory(1)->create();
        Festival::factory(1)->create();
        BusInfo::factory(1)->create();
        Route::factory(1)
            ->has(
                BusInUse::factory(1)

                    ->has(User::factory(1, ['role_id' => 3]))
            )
            ->create();
//            ->has(
//                BusInUse::factory(1)
//////                    ->has(User::factory(1, ['role_id' => 3]))
//            )
        User::factory(1)
            ->has(Order::factory(1))
            ->create();
    }
}
