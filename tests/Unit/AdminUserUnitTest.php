<?php

namespace Tests\Unit;

use App\Models\Festival;
use App\Models\Location;
use App\Models\User;
use Tests\TestCase;


class AdminUserUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_change_user_role(): void
    {
        $user = User::factory()->create(['role_id' => 1]);
        $response = $this->actingAs($user)
            ->patch(route('admin.users.update',$user->id), [
                'role_id' => 2
            ]);

        $response->assertStatus(200);
    }
}
