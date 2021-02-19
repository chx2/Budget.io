<?php

namespace Database\Factories;

use App\Models\Budget;
use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expense::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'budget_id' => Budget::factory()->create()->id,
            'due_date' => $this->faker->dateTime,
            'source' => $this->faker->sentence,
            'amount' => $this->faker->randomNumber(),
            'notes' => $this->faker->sentence
        ];
    }
}
