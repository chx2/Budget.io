<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * Test instantiation of the base model.
     *
     * @return void
     */
    public function test_can_create_users()
    {
        User::factory()->create();
        $this->assertDatabaseCount('users', 1);
    }
}
