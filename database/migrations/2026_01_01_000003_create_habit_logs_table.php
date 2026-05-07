<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('habit_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('habit_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // The date this habit was completed (date only, no time)
            $table->date('completed_at');

            // Optional note for that day
            $table->string('notes')->nullable();

            $table->timestamps();

            // CRITICAL: one log per habit per day — no duplicates
            $table->unique(['habit_id', 'completed_at']);

            // Index for fast streak/calendar queries
            $table->index(['user_id', 'completed_at']);
            $table->index(['habit_id', 'completed_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('habit_logs');
    }
};
