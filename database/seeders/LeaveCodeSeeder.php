<?php

namespace Database\Seeders;

use App\Models\LeaveCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LeaveCode::factory()
        ->count(5)
        ->create();
    }
}
