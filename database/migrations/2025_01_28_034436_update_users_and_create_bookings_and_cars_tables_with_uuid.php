<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersAndCreateBookingsAndCarsTablesWithUuid extends Migration
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
     *
     * @return void
     */
    public function up()
    {
        // Modify the users table
        Schema::table('users', function (Blueprint $table) {
            $table->uuid('id')->change(); // Change primary key to UUID
            $table->enum('role', ['CUSTOMER', 'MANAGER', 'STAFF', 'ADMIN'])->after('updated_at');
            $table->string('phone')->unique()->after('role');
            $table->string('address')->nullable()->after('phone');
            $table->string('id_card')->nullable()->after('address');
            $table->string('driving_license')->nullable()->after('id_card');
        });

        Schema::create('picklists', function (Blueprint $table) {
            $table->id();
            $table->string('value'); // Dropdown value
            $table->string('category'); // Category (e.g., "car_type", "steering_type", "brand")
            $table->boolean('is_custom')->default(false); // Indicates if the value is custom
            $table->timestamps();
        });

        // Create the cars table
        Schema::create('cars', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('card_image');
            $table->json('images');
            $table->text('description');
        
            $table->unsignedBigInteger('type_id')->nullable(); // Reference to picklists (integer)
            $table->unsignedBigInteger('steering_id')->nullable(); // Reference to picklists (integer)
            $table->unsignedBigInteger('brand_id')->nullable(); // Reference to picklists (integer)
        
            $table->string('model');
            $table->integer('gasoline');
            $table->integer('capacity');
            $table->decimal('price', 10, 2);
            $table->boolean('has_promotion')->default(false);
            $table->decimal('promotion_price', 10, 2)->nullable();
            $table->integer('rent_times')->default(0);
            $table->float('rating')->default(0);
            $table->timestamps();
        
            // Foreign keys referencing picklists
            $table->foreign('type_id')->references('id')->on('picklists')->onDelete('set null');
            $table->foreign('steering_id')->references('id')->on('picklists')->onDelete('set null');
            $table->foreign('brand_id')->references('id')->on('picklists')->onDelete('set null');
        });

        // Create the bookings table
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Primary key as UUID
            $table->uuid('customer_id'); // Foreign key as UUID
            $table->uuid('car_id'); // Foreign key as UUID
            $table->enum('pick_up_city', $this->city_provinces); // Update with actual cities
            $table->timestamp('pick_up_datetime');
            $table->enum('drop_off_city', $this->city_provinces); // Update with actual cities
            $table->timestamp('drop_off_datetime');
            $table->enum('stage', ['BOOKING', 'RENTING', 'HISTORY']);
            $table->enum('payment_status', ['PENDING', 'PAID', 'REFUNDING', 'REFUNDED']);
            $table->enum('progress_status', ['PENDING', 'IN_PROGRESS', 'CANCELLED', 'COMPLETED']);
            $table->string('name');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_proof')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revert the users table changes
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone', 'address', 'id_card', 'driving_license']);
            $table->dropColumn('id'); // Drop the UUID column
        });

        // Recreate the original `id` column as bigIncrements
        Schema::table('users', function (Blueprint $table) {
            $table->bigIncrements('id')->first(); // Recreate `id` as auto-increment
        });

        // Drop the bookings table
        Schema::dropIfExists('bookings');

        // Drop the cars table
        Schema::dropIfExists('cars');

        Schema::dropIfExists('picklists');
    }
}
