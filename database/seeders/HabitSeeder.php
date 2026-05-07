<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Habit;
use App\Models\HabitLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class HabitSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if (! $user) return;

        $categories = Category::where('user_id', $user->id)
            ->pluck('id', 'name');

        // Sample habits with their category
        $habits = [
            ['name' => 'Drink 8 glasses of water', 'icon' => '💧', 'color' => '#3b82f6', 'category' => 'Health'],
            ['name' => 'Exercise for 30 minutes',  'icon' => '🏃', 'color' => '#22c55e', 'category' => 'Fitness'],
            ['name' => 'Read for 20 minutes',      'icon' => '📖', 'color' => '#8b5cf6', 'category' => 'Learning'],
            ['name' => 'Meditate for 10 minutes',  'icon' => '🧘', 'color' => '#f59e0b', 'category' => 'Mindfulness'],
            ['name' => 'Eat vegetables',           'icon' => '🥦', 'color' => '#ef4444', 'category' => 'Nutrition'],
            ['name' => 'Sleep 8 hours',            'icon' => '😴', 'color' => '#6366f1', 'category' => 'Health'],
        ];

        foreach ($habits as $data) {
            $habit = Habit::firstOrCreate(
                ['user_id' => $user->id, 'name' => $data['name']],
                [
                    'category_id' => $categories[$data['category']] ?? null,
                    'icon'        => $data['icon'],
                    'color'       => $data['color'],
                    'frequency'   => 'daily',
                    'is_active'   => true,
                ]
            );

            // Seed 30 days of realistic log data
            // ~80% completion rate to simulate real usage
            for ($i = 30; $i >= 0; $i--) {
                if (rand(1, 10) <= 8) { // 80% chance
                    $date = Carbon::today()->subDays($i)->toDateString();
                    HabitLog::firstOrCreate([
                        'habit_id'     => $habit->id,
                        'user_id'      => $user->id,
                        'completed_at' => $date,
                    ]);
                }
            }
        }
    }
}
