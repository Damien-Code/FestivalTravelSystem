<?php

namespace Tests\Feature;

use App\Models\BusInfo;
use App\Models\BusInUse;
use App\Models\Festival;
use App\Models\FestivalInfo;
use App\Models\Location;
use App\Models\Order;
use App\Models\Route;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Benchmark;
use Tests\TestCase;

class BenchmarkTest extends TestCase
{
//    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_fill_database_and_test_simple_data(): void
    {
        BusInfo::factory()->count(1_000)->create();
        Location::factory()->count(100)->create();
        FestivalInfo::factory()->count(100)->create();
        Festival::factory()->count(1_000)->create();
        Route::factory()->count(1_000)->create();
        User::factory()->count(100)->create(['role_id' => 3]);
        BusInUse::factory()->count(1_000)->create();
        User::factory()->count(1_000)->has(Order::factory()->count(rand(0, 10)))->create();

        Benchmark::measure([
            'Scenario 1: Count Users' => fn () => User::count(),
            'Scenario 2: Count Orders' => fn () => Order::count(),
            'Scenario 3: Access Homepage' => fn () => $this->get(route('homepage'))->assertOk(),
            'Scenario 4: Access Routes' => fn () => $this->get(route('festivals.index'))->assertOk(),
            'Scenario 5: Access Routes page 50' => fn () => $this->get(route('festivals.index', ['page' => 50]))->assertOk(),
        ]);
    }

    public function test_measure_1_iterations_accessing_festivals_index()
    {
        Benchmark::measure([
            'Scenario 6: Access festivals index' => fn () => $this->get(route('festivals.index'))->assertOk(),
        ], 1);
    }

    public function test_measure_1000_iterations_accessing_festivals_index()
    {
        Benchmark::measure([
            'Scenario 6: Access festivals index' => fn () => $this->get(route('festivals.index'))->assertOk(),
        ], 1000);
    }

    public function test_measure_1_iterations_accessing_festivals_show()
    {
        Benchmark::measure([
            'Scenario 7: Access festivals show' => fn () => $this->get(route('festivals.show', Festival::inRandomOrder()->first()))->assertOk(),
        ], 1);
    }

    public function test_measure_1000_iterations_accessing_festivals_show()
    {
        Benchmark::measure([
            'Scenario 8: Access festivals show' => fn () => $this->get(route('festivals.show', Festival::inRandomOrder()->first()))->assertOk(),
        ], 1000);
    }
}
