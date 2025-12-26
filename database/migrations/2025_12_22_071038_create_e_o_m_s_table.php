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

            $table->date('date_in')->nullable();
            $table->date('date_out')->nullable();

            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();

            $table->integer('total_minutes')->default(0);
            $table->integer('under_time_minutes')->default(0);
            $table->integer('regular_minutes')->default(0);
            $table->integer('late_minutes')->default(0);
            $table->integer('overtime_minutes')->default(0);
            $table->integer('leave_credit')->nullable();

            $table->integer('approved_overtime')->default(0);

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
