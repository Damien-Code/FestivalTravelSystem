<?php

namespace Tests\Unit;

use App\Models\Festival;
use App\Models\Location;
use App\Models\User;
use Tests\TestCase;


class AdminUserUnitTest extends TestCase
{
    /**
     * @author Mischa Sasse
     * 
     * This test creates a user,
     * then it updates its role
     * then it checks if the role has been changed in the database
     */
    public function test_change_user_role(): void
    {
        $user = User::factory()->create(['role_id' => 1]);
        $this->actingAs($user)
            ->patch(route('admin.users.update',$user->id), [
                'role_id' => 2
            ]);

        $this->assertDatabaseHas('users', [
                'id' => $user->id,
                'role_id' => 2
            ]);
        // $response->assertStatus(200);
    }

    /** 
     * @author Mischa Sasse
     * 
     * This test creates 2 users,
     * then user1 tries to delete user2
     */
    public function test_delete_user(): void
    {
        $user1 = User::factory()->create(['role_id' => 1]);
        $user2 = User::factory()->create(['role_id' => 1]);
            $this->actingAs($user1)
                ->delete(route('admin.users.destroy', $user2->id));
            $this->assertSoftDeleted('users', [
                'id' => $user2->id,
            ]);
    }
}
