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
        Budget::factory()->count(3)->create();
        $this->assertDatabaseCount('budgets', 3);
    }

    public function test_can_attach_incomes()
    {
        Budget::factory()
            ->has(Income::factory()->count(3), 'incomes')
            ->create();
        $this->assertDatabaseCount('incomes', 3);
    }

    public function test_can_attach_expenses()
    {
        Budget::factory()
            ->has(Expense::factory()->count(3), 'expenses')
            ->create();
        $this->assertDatabaseCount('expenses', 3);
    }
}
