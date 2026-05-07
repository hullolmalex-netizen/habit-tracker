<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            // Owner of this category
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete(); // delete categories when user is deleted

            $table->string('name');          // e.g. "Health", "Fitness"
            $table->string('color', 7)->default('#22c55e'); // hex color
            $table->string('icon', 10)->default('⭐');      // emoji icon

            $table->timestamps();

            // One user can't have two categories with the same name
            $table->unique(['user_id', 'name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
