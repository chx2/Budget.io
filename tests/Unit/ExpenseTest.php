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
    public function test_example()
    {
        Expense::factory()->count(3)->create();
        $this->assertDatabaseCount('expenses', 3);
    }
}
