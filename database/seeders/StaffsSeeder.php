<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Database\Seeder;

class StaffsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(15)->create([
            'email_verified_at' => now(),
            'password' => '$2y$10$WPz.VAQu3UuvX6mfVkJWe.QYqKSARTkBEWzPyUiFJ0wHXyNz/roOy',
            'role' => UserRole::Staff
        ]);
    }
}
