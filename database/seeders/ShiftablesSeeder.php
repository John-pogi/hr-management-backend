<?php

namespace Database\Seeders;

use App\Models\Shift;
use App\Models\Shiftables;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShiftablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shiftables::factory()
        ->count(5)
        ->create();
    }
}
