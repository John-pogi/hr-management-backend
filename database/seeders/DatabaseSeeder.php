<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            DepartmentSeeder::class,
            CompanySeeder::class,
            EmployeeSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            SupervisorSeeder::class,
            LeaveTypeSeeder::class,
            LeaveCodeSeeder::class,
            LeaveTypeSeeder::class,
            LeaveSeeder::class,
            DTRSeeder::class,
            ShiftSeeder::class,
            HolidaySeeder::class,
            UploadSeeder::class,
            EOMSeeder::class,
            DepartmentableSeeder::class,
            ScheduleSeeder::class,
            ScheduleListSeeder::class,
            IrregEmployeeScheduleSeeder::class,
            ShiftablesSeeder::class
        ]);
        
    }
}
