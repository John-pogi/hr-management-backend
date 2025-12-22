<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Holiday>
 */
class HolidayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->randomElement([
                'New Year\'s Day',
                'Labor Day',
                'Independence Day',
                'Christmas Day',
                'Company Holiday',
            ]),
            'type'  => $this->faker->randomElement(['regular', 'special', 'company']),
            'date'  => $this->faker->dateTimeThisYear()->format('Y-m-d'),
        ];
    }
}
