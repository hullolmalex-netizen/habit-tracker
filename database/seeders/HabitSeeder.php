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

        $categories = Category::where('user_id', $user->id)->pluck('id', 'name');

        $habits = [
            ['name' => 'Drink 8 glasses of water', 'icon' => 'water',    'color' => '#3b82f6', 'category' => 'Health'],
            ['name' => 'Exercise for 30 minutes',  'icon' => 'exercise', 'color' => '#22c55e', 'category' => 'Fitness'],
            ['name' => 'Read for 20 minutes',      'icon' => 'book',     'color' => '#8b5cf6', 'category' => 'Learning'],
            ['name' => 'Meditate for 10 minutes',  'icon' => 'mindful',  'color' => '#f59e0b', 'category' => 'Mindfulness'],
            ['name' => 'Eat vegetables',           'icon' => 'nutrition','color' => '#ef4444', 'category' => 'Nutrition'],
            ['name' => 'Sleep 8 hours',            'icon' => 'sleep',    'color' => '#6366f1', 'category' => 'Health'],
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

            for ($i = 30; $i >= 0; $i--) {
                if (rand(1, 10) <= 8) {
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
