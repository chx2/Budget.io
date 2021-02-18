<?php

namespace Tests\Unit;

use App\Models\Expense;
use Tests\TestCase;

class ExpenseTest extends TestCase
{
    /**
     * Test instantiation of the base model.
     *
     * @return void
     */
    public function test_can_create_expenses()
    {
        Expense::factory()->create();
        $this->assertDatabaseCount('expenses', 1);
    }
}
