<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shift>
 */
class ShiftFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->time('H:i:s');
        $startDateTime = $this->faker->dateTimeBetween('today 06:00', 'today 14:00');
        $endDateTime   = (clone $startDateTime)->modify('+8 hours');

        $days = $this->faker->randomElements(
            ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            $this->faker->numberBetween(1, 5)
        );

        return [
            'title'       => $this->faker->randomElement(['Morning Shift', 'Afternoon Shift', 'Night Shift']),
            'start_time'  => $startDateTime->format('H:i:s'),
            'end_time'    => $endDateTime->format('H:i:s'),
            'day_of_week' => $days,      // cast to array on model; stored as JSON
            'flag'        => $this->faker->boolean(90), // mostly active
        ];
    }
}
