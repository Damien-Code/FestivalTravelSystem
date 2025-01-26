<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    public function test_contact_page_viewable(): void
    {
        $response = $this->get(route('contact.index'));
        $response->assertStatus(200);
        $response->assertViewIs('contact.index');
    }

    /**
     * @author Brighton van Rouendal
     *
     * Test that guest can send a post request with data
     * Assert that 'success' has been sent back and database has post
     */
    public function test_contact_page_post_message(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'message' => 'I am a message from John Doe',
        ];

        $response = $this->post(route('contact.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHas('success');
        $response->assertRedirect(route('contact.index'));
        $this->assertDatabaseHas('contacts', $data);
    }

    /**
     * @author Brighton van Rouendal
     *
     * Test that guest send invalid message due to incorrect length 'message'
     * Assert that error for 'message' was sent back and database doesn't have post
     */
    public function test_contact_page_post_invalid_message(): void
    {
        $data = [
            'name' => 'Jane Doe',
            'email' => 'jane@doe.com',
            'message' => 'Incorrect',
        ];

        $response = $this->post(route('contact.store'), $data);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('message');
        $response->assertSessionMissing('success');
        $this->assertDatabaseMissing('contacts', $data);
    }

    /**
     * @author Brighton van Rouendal
     *
     * Test that an admin user is able to view all contact messages
     * Assert view is the index for admin contacts
     */
    public function test_admin_contact_list_viable_as_admin(): void
    {
        $user = User::factory()->create(['role_id' => 1]);
        $response = $this->actingAs($user)->get(route('admin.contact.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.contact.index');
    }

    /**
     * @author Brighton van Rouendal
     *
     * Test that logged-in user is not authorized to view admin page
     * Assert status code is 403 unauthorized
     */
    public function test_admin_contact_list_not_visable_as_non_admin(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('admin.contact.index'));
        $response->assertStatus(403);
    }

    /**
     * @author Brighton van Rouendal
     *
     * Test that guest is redirected to login page to view admin contact list
     * Assert redirect is to login page
     */
    public function test_admin_contact_list_not_visable_as_guest(): void
    {
        $response = $this->get(route('admin.contact.index'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @author Brighton van Rouendal
     *
     * Test admin able to delete contact
     * Assert session has 'success' and that database has softDeleted the contact message
     */
    public function test_admin_contact_delete_contact_message(): void
    {
        $contact = Contact::factory()->create();
        $user = User::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($user)->delete(route('admin.contact.destroy', $contact));
        $response->assertStatus(302);
        $response->assertSessionHas('success');
        $response->assertRedirect(route('admin.contact.index'));
        $this->assertSoftDeleted('contacts', ['id' => $contact->id]);
    }

    /**
     * @author Brighton van Rouendal
     *
     * Test admin able to view single contact
     * Assert view is admin contact show and status is 200
     */
    public function test_admin_contact_show_individual_contact():void
    {
        $contact = Contact::factory()->create();
        $user = User::factory()->create(['role_id' => 1]);
        $response = $this->actingAs($user)->get(route('admin.contact.show', $contact));
        $response->assertStatus(200);
        $response->assertViewIs('admin.contact.show');
    }
}
