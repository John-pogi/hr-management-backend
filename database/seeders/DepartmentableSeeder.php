<?php

namespace Database\Seeders;

use App\Models\Departmentable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Departmentable::factory()
        ->count(5)
        ->create();
    }
}
