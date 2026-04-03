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
        Schema::create('patient_conditions', function (Blueprint $table) {
            $table->id('patient_condition_id');
            $table->foreignId('appointment_id')
                ->constrained('appointments', 'appointment_id')
                ->restrictOnDelete();
            $table->foreignId('condition_id')
                ->constrained('medical_conditions', 'id')
                ->restrictOnDelete();
            $table->text('notes')
                ->nullable();
            $table->timestamps();

            $table->unique(['appointment_id', 'condition_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_conditions');
    }
};
