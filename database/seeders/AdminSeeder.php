<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory(1)->create([
            'name' => 'BOREN',
            'email' => 'borenmon5@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$znr8DiXqJHAaaI/Iw6aE3eZNy8T9ZLKDr6zzvT0UFHtIZNL5UI/U.',
            'phone' => '011530990',
            'role' => UserRole::Admin
        ]);
    }
}
