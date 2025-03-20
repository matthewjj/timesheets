<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Timesheet>
 */
class TimesheetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'task_date' => $this->faker->date(),
            'task_name' => $this->faker->name(),
            'task_duration_minutes' => $this->faker->numberBetween(1, 1000),
        ];
    }
}
