<?php

namespace Database\Factories;

use App\Models\Budget;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BudgetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Budget::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'uid' => $this->faker->uuid,
            'user_id' => User::factory()->create()->id,
            'start_date' => $this->faker->dateTime,
            'end_date' => $this->faker->dateTime,
        ];
    }
}
