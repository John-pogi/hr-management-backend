<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DTR>
 */
class DTRFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $date = $this->faker->dateTimeBetween('-1 month', 'now');

        return [
            'employee_number' => Employee::find(1)->value('employee_number'),                // FK to employees
            'date'        => $date->format('Y-m-d'),
            'time'        => $this->faker->time('H:i:s'),
            'type'        => $this->faker->randomElement(['IN', 'OUT']),
            //
        ];
    }
}
