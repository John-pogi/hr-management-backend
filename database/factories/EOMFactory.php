<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EOM>
 */
class EOMFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       // Create a random work day and shift times
        $date        = $this->faker->dateTimeBetween('-1 month', 'now');
        $shiftStart  = $this->faker->dateTimeBetween(
            $date->format('Y-m-d').' 06:00',
            $date->format('Y-m-d').' 10:00'
        );
        $shiftEnd    = (clone $shiftStart)->modify('+8 hours');

        // Actual time-in/out somewhere inside the shift
        $timeIn  = (clone $shiftStart)->modify('+'.$this->faker->numberBetween(0, 60).' minutes');
        $timeOut = (clone $shiftEnd)->modify('-'.$this->faker->numberBetween(0, 60).' minutes');

        $totalHours = ($timeOut->getTimestamp() - $timeIn->getTimestamp()) / 3600;

        return [
            'employee_id' => Employee::factory(),
            'date'        => $date->format('Y-m-d'),
            'time_in'     => $timeIn->format('H:i:s'),
            'time_out'    => $timeOut->format('H:i:s'),
            'total_hours' => round($totalHours, 2),
            'shift_start' => $shiftStart->format('H:i:s'),
            'shift_end'   => $shiftEnd->format('H:i:s'),
        ];
    }
}
