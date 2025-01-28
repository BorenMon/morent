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
            ['value' => 'SUV', 'category' => 'car_type', 'is_custom' => false],
            ['value' => 'Sedan', 'category' => 'car_type', 'is_custom' => false],
            ['value' => 'Hatchback', 'category' => 'car_type', 'is_custom' => false],
            ['value' => 'Manual', 'category' => 'steering_type', 'is_custom' => false],
            ['value' => 'Automatic', 'category' => 'steering_type', 'is_custom' => false],
            ['value' => 'Toyota', 'category' => 'brand', 'is_custom' => false],
            ['value' => 'Honda', 'category' => 'brand', 'is_custom' => false],
        ]);
    }
}
