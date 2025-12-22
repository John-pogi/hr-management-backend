<?php

namespace Database\Seeders;

use App\Models\EOM;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EOMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EOM::factory()
        ->count(5)
        ->create();
    }
}
