<?php

namespace Tests\Feature;

use App\Models\Festival;
use App\Models\Location;
use App\Models\User;
use Faker\Core\DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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

    /**
     * @author Damiën van den IJssel
     * @return void
     * Create user that has admin role
     * Get the uri that can only be accessed by admin
     */
    public function test_admin_festivals_page_can_be_rendered(): void
    {
        $user = User::factory()->create(['role_id' => 1]);
        $response = $this->actingAs($user)->get('/admin/festivals');
        $response->assertStatus(200);
    }

    /**
     * @author Damiën van den IJssel
     * @return void
     * Create user that has not the admin role
     * Get the uri that can only be accessed by admin
     */
    public function test_admin_festivals_page_cannot_be_rendered_if_not_admin(): void
    {
        $user = User::factory()->create(['role_id' => 2]);
        $response = $this->actingAs($user)->get('/admin/festivals');
        $response->assertStatus(403);
    }

    /**
     * @return void
     * @author Damiën van den IJssel
     * create user so it is able to store data
     * post to db
     * check if db has these data
     */
    public function test_festival_can_be_stored_to_database(): void
    {
        $user = User::factory()->create(['role_id' => 1]);
        $data = [
            'title' => 'Festival 1',
            'description' => 'Festival 1 description',
            // create fake image upload
            'image' => UploadedFile::fake()->image('festival1.png'),
        ];
        $this->actingAs($user)
            ->post(route('admin.festivals.store'), [
                'title' => $data['title'],
                'description' => $data['description'],
                'image' => $data['image'],
            ]);
        $this->assertDatabaseHas('festival_info', [
            'title' => 'Festival 1',
            'description' => 'Festival 1 description',
            // encode image so it matches the fake image upload
            'image' => 'data:image/png;base64, ' . base64_encode(file_get_contents($data['image'])),
        ]);
    }

    /**
     * @return void
     * @author Damiën van den IJssel
     * create user so it is able to store data
     * create location for festival
     * create festival info
     * pair festival info to date
     * check if db has these data
     */
    public function test_stored_festival_can_be_paired()
    {
        Location::factory()->create();
        $user = User::factory()->create(['role_id' => 1]);
        $this->actingAs($user)
            ->post(route('admin.festivals.store'), [
                'title' => 'Festival 1',
                'description' => 'Festival 1 description',
            ]);

        $date = fake()->dateTimeBetween('now', '+1 years')->format('Y-m-d');

        $this->actingAs($user)
            ->post(route('admin.festivals.planFestival'), [
                'festival' => 2,
               'location' => 1, // Wordt niet gebruikt in de controller
                'date' => $date,
            ]);
        $this->assertDatabaseHas('festivals', [
            'info_festival_id' => 2,
            'date' => $date,
        ]);
    }


    /**
     * @author Damiën van den IJssel & Brighton van Rouendal
     * Create location
     * Create user
     * Store festival and pair it with date
     * Brighton found out that festival had to be ordered on ID
     * Delete the last id in DB
     * Assert that festival had been soft deleted
     * @return void
     */
    public function test_festival_can_be_soft_deleted()
    {
        Location::factory()->create();
        $user = User::factory()->create(['role_id' => 1]);
        $this->actingAs($user)
            ->post(route('admin.festivals.store'), [
                'title' => 'Festival 3',
                'description' => 'Festival 3 description',
            ]);
            // dd(FestivalInfo::all());
        $date = fake()->dateTimeBetween('now', '+1 years')->format('Y-m-d H:i:s');

        $this->actingAs($user)
            ->post(route('admin.festivals.planFestival'), [
                'festival' => 3,
                'location' => 2,
                'date' => $date,
            ]);
            
        $festival_id = Festival::orderBy('id', 'desc')->first()->id;
        $this->actingAs($user)
            ->delete(route('admin.festivals.destroy', $festival_id));
        $this->assertSoftDeleted('festivals', [
            'id' => $festival_id,
        ]);



    }
}
