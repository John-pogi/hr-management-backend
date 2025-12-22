<?php

namespace Database\Seeders;

use App\Models\IrregEmployeeSchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IrregEmployeeScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        IrregEmployeeSchedule::factory()
        ->count(5)
        ->create();

    }
}
