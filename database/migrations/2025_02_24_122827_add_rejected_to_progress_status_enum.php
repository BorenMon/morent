<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modify the enum field to add more values (works for MySQL)
        DB::statement("ALTER TABLE bookings MODIFY progress_status ENUM('PENDING', 'IN_PROGRESS', 'CANCELLED', 'COMPLETED', 'REJECTED')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE bookings MODIFY progress_status ENUM('PENDING', 'IN_PROGRESS', 'CANCELLED', 'COMPLETED')");
    }
};
