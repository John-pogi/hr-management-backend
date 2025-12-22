<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Shift;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IrregEmployeeSchedule>
 */
class IrregEmployeeScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         $date = $this->faker->dateTimeThisYear();

        // ISO week number (1–53)
        $weekNumber = (int) $date->format('W');

        return [
            'date'        => $date->format('Y-m-d'),
            'employee_id' => Employee::factory(),
            'shift_id'    => Shift::factory(),
            'week_number' => $weekNumber,
        ];
    }
}
