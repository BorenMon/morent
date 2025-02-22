<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $city_provinces = [
        'PHNOM_PENH',
        'BANTEAY_MEANCHEY',
        'BATTAMBANG',
        'KOH_KONG',
        'KAMPONG_CHAM',
        'KAMPONG_CHHNANG',
        'KAMPONG_SPEU',
        'KAMPONG_THOM',
        'KANDAL',
        'KEP',
        'KRATIE',
        'MONDULKIRI',
        'PREAH_VIHEAR',
        'PURSAT',
        'RATANAKIRI',
        'SIEM_REAP',
        'SIHANOUKVILLE',
        'SAMBOR_PREI_KUK',
        'STUNG_TRENG',
        'SVAY_RIENG',
        'TAKEO',
        'TBOUNG_KHMUM',
        'ODDAR_MEANCHEY',
        'PREY_VENG',
        'PAILIN'
    ];
    
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('pick_up_city', 255)->change();
            $table->string('drop_off_city', 255)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->enum('pick_up_city', $this->city_provinces)->change();
            $table->enum('drop_off_city', $this->city_provinces)->change();
        });
    }
};
