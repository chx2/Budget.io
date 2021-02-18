<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * Test a basic HTTP request.
     *
     * @return void
     */
    public function test_can_visit_homepage()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_can_authenticate()
    {
        $user = User::factory()->create([
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' // password
        ]);

        $response = $this->post('/login', [
            'email' => 'test@test.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/budgets');
        $this->assertAuthenticatedAs($user);
    }

    public function test_redirect_unauthenticated_requests()
    {
        $response = $this->get('/budgets');
        $response->assertStatus(302);
    }
}
