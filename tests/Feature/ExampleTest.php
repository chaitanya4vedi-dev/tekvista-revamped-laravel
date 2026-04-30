<?php

namespace Tests\Feature;

use App\Models\ContactInquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response
            ->assertStatus(200)
            ->assertSee('Tekvista Infosolutions')
            ->assertSee('/manifest.webmanifest');
    }

    public function test_contact_inquiry_can_be_submitted(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Aditi Sen',
            'email' => 'aditi@example.com',
            'company' => 'North Star Trading',
            'phone' => '+91 9876543210',
            'service' => 'Cloud Solutions',
            'message' => 'We need help planning a cloud backup and network security project.',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas(ContactInquiry::class, [
            'email' => 'aditi@example.com',
            'service' => 'Cloud Solutions',
        ]);
    }
}
