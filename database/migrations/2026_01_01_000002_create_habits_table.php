<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('habits', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('category_id')
                  ->nullable()          // habit doesn't NEED a category
                  ->constrained()
                  ->nullOnDelete();     // if category deleted, set null

            // Habit details
            $table->string('name');                          // "Drink water"
            $table->text('description')->nullable();         // optional details
            $table->string('color', 7)->default('#22c55e');  // card color
            $table->string('icon', 10)->default('✅');       // emoji
            $table->enum('frequency', ['daily', 'weekly'])->default('daily');
            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes(); // keeps history even after "deletion"

            // Index for fast queries: "get all habits for user X"
            $table->index(['user_id', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('habits');
    }
};
