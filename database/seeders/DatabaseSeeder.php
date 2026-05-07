<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create a demo user if none exists
        $user = User::firstOrCreate(
            ['email' => 'demo@habittracker.com'],
            [
                'name'     => 'Demo User',
                'password' => Hash::make('password'),
            ]
        );

        // Run seeders in order (categories first, then habits)
        $this->call([
            CategorySeeder::class,
            HabitSeeder::class,
        ]);
    }
}
