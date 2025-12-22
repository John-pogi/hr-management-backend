<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
            'fullname'        => $this->faker->name(),
            'email'           => $this->faker->unique()->safeEmail(),
            'department'      => $this->faker->randomElement(['IT', 'HR', 'Finance', 'Sales']),
            'company'         => $this->faker->company(),
            'position'        => $this->faker->jobTitle(),
            'contact'         => $this->faker->phoneNumber(),
            'sss'             => $this->faker->numerify('##-#######-#'),
            'pagibig'         => $this->faker->numerify('####-####-####'),
            'tin'             => $this->faker->numerify('###-###-###'),
            'start_date'      => $this->faker->date(),
            'hired_date'      => $this->faker->date(),
            'employee_number' => $this->faker->unique()->numerify('EMP####'),
            'basic_pay'       => $this->faker->randomFloat(2, 10000, 80000),
            'philhealth'      => $this->faker->numerify('##-#########-#'),
            'department_id'    => Department::factory(),
            'company_id'    => Company::factory()
        ];
    }
}
