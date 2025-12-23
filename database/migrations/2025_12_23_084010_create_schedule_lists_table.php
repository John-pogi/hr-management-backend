<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedule_lists', function (Blueprint $table) {
            $table->id();

            $table->foreignId('schedule_id')
                  ->nullable()
                  ->constrained('schedules'); 

            $table->foreignId('shift_id')
                  ->nullable()
                  ->constrained('shifts');

            $table->unsignedTinyInteger('week_number'); // 1–53

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_lists');
    }
};
