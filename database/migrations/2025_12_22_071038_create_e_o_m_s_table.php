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
        Schema::create('eom', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')
                  ->nullable()
                  ->constrained('employees');

            $table->date('date');

            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();

            // total hours worked that day
            $table->decimal('total_hours', 5, 2)->default(0);

            $table->time('shift_start')->nullable();
            $table->time('shift_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eom');
    }
};
