<?php

namespace Tests\Unit;

use App\Models\Budget;
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

    /**
     * Make sure a budget can be set as parent.
     *
     * @return void
     */
    public function test_belongs_to_budget()
    {
        $budget = Budget::factory()->create();
        $expense = Expense::factory()->create([
            'budget_id' =>  $budget->id
        ]);
        $this->assertNotNull($expense->budget);
    }
}
