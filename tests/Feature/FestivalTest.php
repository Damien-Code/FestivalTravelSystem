<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\FestivalInfo;

class FestivalTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_festival_can_be_stored_to_database(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->post(route('admin.festivals.store'), [
                'title' => 'Festival 1',
                'description' => 'Festival 1 description',
//                'image' => fake('image.jpg'),
            ]);
        $this->assertDatabaseHas('festival_info', [
            'title' => 'Festival 1',
            'description' => 'Festival 1 description',
//            'image' => 'image.jpg',
        ]);
    }
}
