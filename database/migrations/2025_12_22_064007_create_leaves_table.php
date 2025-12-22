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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')
                  ->nullable()
                  ->constrained('employees');   

            $table->foreignId('leave_type_id')
                  ->nullable()
                  ->constrained('leave_types');       

            $table->foreignId('leave_code_id')
                    ->nullable()
                    ->constrained('leave_codes');

            $table->date('start_date');
            $table->date('end_date');

            // Approval fields
            $table->boolean('is_approved')->default(false);
            
            $table->foreignId('approved_by')
                  ->nullable()
                  ->constrained('employees');

            $table->dateTime('approved_date')->nullable();

            // Extra
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
