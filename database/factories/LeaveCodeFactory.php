<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeaveCode>
 */
class LeaveCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $end   = $this->faker->dateTimeBetween($start, '+6 months');

        return [
            'code'        => strtoupper($this->faker->unique()->bothify('LC###??')),
            'valid_start' => $start->format('Y-m-d'),
            'valid_end'   => $end->format('Y-m-d'),
        ];
    }
}
