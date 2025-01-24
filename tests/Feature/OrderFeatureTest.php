<?php

namespace Tests\Feature;

use App\Models\Festival;
use App\Models\Route;
use App\Models\User;
use Database\Factories\FestivalFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderFeatureTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_guest_gets_redirected_to_login_page_when_accessing_order_page(): void {
        $festival = Festival::factory()->create();
        $route = Route::factory()->create(['festival_id' => $festival->id]);

        $response = $this->get('/festival/'.$festival->id.'/order/'.$route->id);

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_order_page_is_accessible_as_user(): void {
        $user = User::factory()->create();
        $festival = Festival::factory()->create();
        $route = Route::factory()->create(['festival_id' => $festival->id]);

        $response = $this->actingAs($user)->get('/festival/'.$festival->id.'/order/'.$route->id);

        $response->assertStatus(200);
        $response->assertViewIs('festival.order.index');
    }
}
