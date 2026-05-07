<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public static array $defaults = [
        ['name' => 'Health',      'color' => '#22c55e', 'icon' => 'health'],
        ['name' => 'Fitness',     'color' => '#3b82f6', 'icon' => 'fitness'],
        ['name' => 'Learning',    'color' => '#8b5cf6', 'icon' => 'learning'],
        ['name' => 'Mindfulness', 'color' => '#f59e0b', 'icon' => 'mindfulness'],
        ['name' => 'Nutrition',   'color' => '#ef4444', 'icon' => 'nutrition'],
        ['name' => 'Social',      'color' => '#ec4899', 'icon' => 'social'],
        ['name' => 'Finance',     'color' => '#14b8a6', 'icon' => 'finance'],
        ['name' => 'Creativity',  'color' => '#f97316', 'icon' => 'creativity'],
    ];

    public function run(): void
    {
        $user = User::first();
        if (! $user) return;

        foreach (self::$defaults as $cat) {
            Category::firstOrCreate(
                ['user_id' => $user->id, 'name' => $cat['name']],
                ['color' => $cat['color'], 'icon' => $cat['icon']]
            );
        }
    }
}
