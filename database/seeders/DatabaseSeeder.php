<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Demo user: aziz@gmail.com / 1234
        $user = User::firstOrCreate(
            ['email' => 'aziz@gmail.com'],
            [
                'name'     => 'Ahmed Aziz',
                'password' => Hash::make('1234'),
            ]
        );

        $this->call([
            CategorySeeder::class,
            HabitSeeder::class,
        ]);
    }
}
