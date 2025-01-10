<?php

namespace Tests\Feature;

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
        $response = $this->actingAs($user)
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
//                'location_id' => 1, // Wordt niet gebruikt in de controller
                'date' => $date,
            ]);
        $this->assertDatabaseHas('festivals', [
            'info_festival_id' => 2,
            'date' => $date,
        ]);
    }
}
