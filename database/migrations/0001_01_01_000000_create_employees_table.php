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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('email')->unique();
            $table->string('position')->nullable();
            $table->string('contact')->nullable();
            $table->string('sss')->nullable();
            $table->string('pagibig')->nullable();
            $table->string('tin')->nullable();
            $table->string('philhealth')->nullable();
            $table->date('start_date')->nullable();
            $table->date('hired_date')->nullable();
            $table->string('employee_number')->unique();
            $table->decimal('basic_pay', 12, 2)->default(0);

            $table->foreignId('department_id')
            ->nullable()
            ->constrained();

            $table->foreignId('company_id')
            ->nullable()
            ->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};