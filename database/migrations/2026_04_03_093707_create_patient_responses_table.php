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
        Schema::create('patient_responses', function (Blueprint $table) {
            $table->id('patient_response_id');
            $table->foreignId('appointment_id')
                ->constrained('appointments', 'appointment_id')
                ->restrictOnDelete(); 
            $table->foreignId('question_id')
                ->constrained('medical_questions', 'question_id')
                ->restrictOnDelete();
            $table->enum('answer', ['Yes', 'No', 'N/A'])->default('No');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['appointment_id', 'question_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_responses');
    }
};
