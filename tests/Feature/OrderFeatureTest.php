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
     * @return void
     * @author Brighton van rouendal
     * Create User
     * Create a Festival which is a day in the past
     * Create a Route which is a day in the past
     * Visit route
     * Assert Redirect
     * Assert View is the festival
     */
    public function test_user_cant_visit_route_that_has_happend()
    {
        $user = User::factory()->create();
        $festival = Festival::factory()->create(['date' => now()->addDay()]);
        $route = Route::factory()->create(['festival_id' => $festival->id, 'departure_time' => now()->subDay()]);
        $response = $this->actingAs($user)->get(route('festivals.order', [$festival, $route]));
        $response->assertStatus(302);
        $response->assertRedirect(route('festivals.show', $festival));
        $response->assertDontSee('Order Details');
    }

    /**
     * @return void
     * @author Brighton van rouendal
     * Create User
     * Create a Festival which is a day in the past
     * Create a Route which is a day in the past
     * Visit route
     * Assert Redirect
     * Assert View is the festival
     */
    public function test_user_cant_visit_route_that_has_happend_redirect_to_festivals_list()
    {
        $user = User::factory()->create();
        $festival = Festival::factory()->create(['date' => now()->subDay()]);
        $route = Route::factory()->create(['festival_id' => $festival->id, 'departure_time' => now()->subDay()]);
        $response = $this->actingAs($user)->get(route('festivals.order', [$festival, $route]));
        $response->assertStatus(302);
        $response->assertDontSee("Festival - {$festival->festivalInfo->title}");
    }

    /**
     * @return void
     * @author Brighton van rouendal
     * Create User
     * Create a Festival which is a day in the past
     * Create a Route which is a day in the past
     * Visit route
     * Place Order
     * Assert Redirect to festival page
     * Assert View is the festival page
     */
    public function test_user_cant_place_order_on_route_that_has_happened_redirect_to_festivals_list()
    {
        $user = User::factory()->create();
        $festival_info = FestivalInfo::factory()->create(['title' => 'Festival Test for redirect when placing order']);
        $festival = Festival::factory()->create(['info_festival_id' => $festival_info->id, 'date' => now()->subDay()]);
        $route = Route::factory()->create(['festival_id' => $festival->id, 'departure_time' => now()->subDay()]);

        $response = $this->actingAs($user)
            ->post(
                route('order.store', [$festival, $route]),
                [
                    'ticket-amount' => 1,
                    'total-price-h' => $route->price,
                ]
            );

        $response->assertStatus(302);
        $response->assertDontSee("Festival - {$festival->festivalInfo->title}");
    }

    /**
     * @return void
     * @author Brighton van rouendal
     * Create User
     * Create a Festival which is a day in the past
     * Create a Route which is a day in the past
     * Visit route
     * Place Order
     * Assert Redirect to festival page
     * Assert View is the festival page
     */
    public function test_user_cant_place_order_on_route_that_has_happened()
    {
        $user = User::factory()->create();
        $festival = Festival::factory()->create(['date' => now()->addDay()]);
        $route = Route::factory()->create(['festival_id' => $festival->id, 'departure_time' => now()->subDay()]);

        $response = $this->actingAs($user)
            ->post(
                route('order.store', [$festival, $route]),
                [
                    'ticket-amount' => 1,
                    'total-price-h' => $route->price,
                ]
            );

        $response->assertStatus(302);
        $response->assertRedirect(route('festivals.show', $festival));
        $response->assertDontSee('Order Details');
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
