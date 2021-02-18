<?php

namespace Tests\Unit;

use App\Models\Budget;
use App\Models\Expense;
use App\Models\Income;
use Tests\TestCase;

class BudgetTest extends TestCase
{
    /**
     * Test instantiation of the base model.
     *
     * @return void
     */
    public function test_can_create_budgets()
    {
        Budget::factory()->create();
        $this->assertDatabaseCount('budgets', 1);
    }

    public function test_can_attach_incomes()
    {
        Budget::factory()
            ->has(Income::factory(), 'incomes')
            ->create();
        $this->assertDatabaseCount('incomes', 1);
    }

    public function test_can_attach_expenses()
    {
        Budget::factory()
            ->has(Expense::factory(), 'expenses')
            ->create();
        $this->assertDatabaseCount('expenses', 1);
    }
}
