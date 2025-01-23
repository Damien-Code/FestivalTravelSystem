<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use App\Models\User;
use Tests\TestCase;

class AdminUserTest extends TestCase
{
    /**
     * @author Mischa Sasse
     * 
     * This test will create a new user with the admin role. 
     * After which it will check if this user can get to the admin view
     */
    public function test_admin_can_navigate_to_admin_users_view(): void
    {
        $user = User::factory()->create(['role_id' => 1]);
        $response = $this->actingAs($user)->get('/admin/users');
        $response->assertStatus(200);
        $response->assertViewIs('admin.users.index');

    
    } 
    /**
     * @author Mischa Sasse
     * 
     * This test will create a new user with a role that is not an admin. 
     * After which it will check if this user cannot access the admin view
     */
    public function test_non_admin_cannot_navigate_to_admin_users_view(): void
    {
        $user = User::factory()->create(['role_id' => 2]);
        $response = $this->actingAs($user)->get('admin/users');
        $response->assertStatus(403);
    }
}
