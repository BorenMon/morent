<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PicklistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('picklists')->insert([
            ['value' => 'SUV', 'category' => 'car_type'],
            ['value' => 'Sedan', 'category' => 'car_type'],
            ['value' => 'Hatchback', 'category' => 'car_type'],
            ['value' => 'Manual', 'category' => 'car_steering'],
            ['value' => 'Automatic', 'category' => 'car_steering'],
            ['value' => 'Toyota', 'category' => 'car_brand'],
            ['value' => 'Honda', 'category' => 'car_brand'],
        ]);
    }
}
