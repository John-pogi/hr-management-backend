<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Schedule;
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


        return [
            'date'        => $date->format('Y-m-d'),
            'employee_id' => Employee::factory(),
            'schedule'    => Schedule::factory()
        ];
    }
}
