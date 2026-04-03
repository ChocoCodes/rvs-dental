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
        Schema::create('appointment_procedures', function (Blueprint $table) {
            $table->id('appointment_procedure_id');
            $table->foreignId('appointment_id')
                ->constrained('appointments', 'appointment_id')
                ->restrictOnDelete();
            $table->foreignId('procedure_id')
                ->constrained('dental_procedures', 'procedure_id')
                ->restrictOnDelete();
            $table->text('notes')
                ->nullable();
            $table->decimal('charged_price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_procedures');
    }
};
