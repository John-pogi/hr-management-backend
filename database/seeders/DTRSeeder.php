<?php

namespace Database\Seeders;

use App\Models\DTR;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DTRSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DTR::factory()
            ->count(4)
            ->create();
    }
}
