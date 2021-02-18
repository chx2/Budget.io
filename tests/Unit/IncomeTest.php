<?php

namespace Tests\Unit;

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
}
