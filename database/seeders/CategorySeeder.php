<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Default categories created for every new demo user.
     * Each has a color and emoji icon.
     */
    public static array $defaults = [
        ['name' => 'Health',     'color' => '#22c55e', 'icon' => '🏥'],
        ['name' => 'Fitness',    'color' => '#3b82f6', 'icon' => '💪'],
        ['name' => 'Learning',   'color' => '#8b5cf6', 'icon' => '📚'],
        ['name' => 'Mindfulness','color' => '#f59e0b', 'icon' => '🧘'],
        ['name' => 'Nutrition',  'color' => '#ef4444', 'icon' => '🥗'],
        ['name' => 'Social',     'color' => '#ec4899', 'icon' => '👥'],
        ['name' => 'Finance',    'color' => '#14b8a6', 'icon' => '💰'],
        ['name' => 'Creativity', 'color' => '#f97316', 'icon' => '🎨'],
    ];

    public function run(): void
    {
        // Create categories for the demo user only
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
