<?php

namespace Database\Factories;

use App\Models\Budget;
use App\Models\Income;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Income::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'budget_id' => Budget::factory()->create()->id,
            'uid' => $this->faker->uuid,
            'source' => $this->faker->sentence,
            'amount' => $this->faker->randomNumber(),
            'notes' => $this->faker->sentence
        ];
    }
}
