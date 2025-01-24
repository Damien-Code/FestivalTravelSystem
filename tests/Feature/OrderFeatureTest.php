<?php

namespace Tests\Feature;

use App\Models\Festival;
use App\Models\FestivalInfo;
use App\Models\Route;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if a user that is not logged in, gets redirected to the login page when trying to access an order page
     * @author Ismael Winterman
     * @return void
     */
    public function test_guest_gets_redirected_to_login_page_when_accessing_order_page(): void {
        $festival = Festival::factory()->create();
        $route = Route::factory()->create(['festival_id' => $festival->id]);

        $response = $this->get(route('festivals.order', [$festival->id, $route->id]));

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /**
     * Test if a user can access an order page when logged in.
     * @author Ismael Winterman
     * @return void
     */
    public function test_order_page_is_accessible_as_user(): void {
        $user = User::factory()->create();
        $festival = Festival::factory()->create();
        $route = Route::factory()->create(['festival_id' => $festival->id]);

        $response = $this->actingAs($user)->get(route('festivals.order', [$festival->id, $route->id]));

        $response->assertStatus(200);
        $response->assertViewIs('festivals.order');
    }

    /**
     * Test if the order page displayed to a logged-in user matches the correct festival and route
     * @author Ismael Winterman
     * @return void
     */
    public function test_order_page_displayed_matches_the_correct_festival_and_route(): void {
        $user = User::factory()->create();
        $festivalInfo = FestivalInfo::factory()->create(['title' => 'Hello World']);
        $festival = Festival::factory()->create(['info_festival_id' => $festivalInfo->id]);

        $date = now();
        $route = Route::factory()->create(['festival_id' => $festival->id, 'departure_time' => $date]);

        $response = $this->actingAs($user)->get(route('festivals.order', [$festival->id, $route->id]));

        $response->assertStatus(200);
        $response->assertViewIs('festivals.order');
        $response->assertSee(['Hello World', $date]);
    }

    /**
     * Test if the vip-checkbox is displayed on the order page, when a user has more than 100 points
     * @author Ismael Winterman
     * @return void
     */
    public function test_order_page_displays_a_vipCheckbox_when_user_has_more_than_100_points (): void {
        $user = User::factory()->create(['tokens' => '9000']);
        $festival = Festival::factory()->create();
        $route = Route::factory()->create(['festival_id' => $festival->id]);

        $response = $this->actingAs($user)->get(route('festivals.order', [$festival->id, $route->id]));
        $response->assertStatus(200);
        $response->assertSeeHtml('<input type="checkbox" id="vip-checkbox"');
    }

    /**
     * Test if the vip-checkbox does not get displayed on the order page, when a user does not have more than 100 points
     * @author Ismael Winterman
     * @return void
     */
    public function test_order_page_does_not_display_a_vipCheckbox_when_user_has_less_than_100_points (): void {
        $user = User::factory()->create(['tokens' => '42']);
        $festival = Festival::factory()->create();
        $route = Route::factory()->create(['festival_id' => $festival->id]);

        $response = $this->actingAs($user)->get(route('festivals.order', [$festival->id, $route->id]));
        $response->assertStatus(200);
        $response->assertDontSeeHtml('<input type="checkbox" id="vip-checkbox"');
    }
}
