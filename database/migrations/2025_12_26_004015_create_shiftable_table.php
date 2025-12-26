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
        Schema::create('shiftables', function (Blueprint $table) {
           
            $table->id();

            $table->foreignId('shift_id')
                  ->nullable()
                  ->constrained('shifts'); 

            $table->foreignId('schedule_list_id')
                  ->nullable()
                  ->constrained('schedule_lists');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shiftables');
    }
};
