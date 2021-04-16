<?php

namespace Tests\Unit;

use App\Models\Budget;
use App\Models\Income;
use Tests\TestCase;

class IncomeTest extends TestCase
{
    /**
     * Test instantiation of the base model.
     *
     * @return void
     */
    public function test_can_create_incomes()
    {
        Income::factory()->create();
        $this->assertDatabaseCount('incomes', 1);
    }

    /**
     * Make sure a budget can be set as parent.
     *
     * @return void
     */
    public function test_belongs_to_budget()
    {
        $budget = Budget::factory()->create();
        $income = Income::factory()->create([
            'budget_id' =>  $budget->id
        ]);
        $this->assertNotNull($income->budget);
    }
}
