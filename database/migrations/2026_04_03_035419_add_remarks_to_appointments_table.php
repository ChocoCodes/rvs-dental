<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE appointments MODIFY COLUMN status ENUM('Scheduled', 'Completed', 'Cancelled', 'No Show')");
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('remarks')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE appointments MODIFY COLUMN status VARCHAR(255) NOT NULL");
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });
    }
};
