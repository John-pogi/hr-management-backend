<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\LeaveType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Leave>
 */
class LeaveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        

      $statuses = ['pending', 'rejected', 'approved'];


      $status = $statuses[
        $this->faker->numberBetween(0, 2)
      ];


        return [
          'employee_id' => Employee::factory(),
          'start_date' => Carbon::now(),
          'end_date' => Carbon::now(),
          'leave_type_id' =>  LeaveType::factory(),
          'leave_code_id' => null,
          'valid_credit' => 0.5,
          'modified_by' => Employee::factory(),
          'modified_date' => Carbon::now(),
          'status' => $status
        ];
    }
}
