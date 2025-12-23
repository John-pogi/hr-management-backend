<?php

namespace Database\Seeders;

use App\Models\ScheduleList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ScheduleList::factory()
            ->count(5)
            ->create();
    }
}
