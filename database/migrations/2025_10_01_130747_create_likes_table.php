<?php
// database/migrations/2025_01_01_000003_create_likes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // BIGINT UNSIGNED NOT NULL
            $table->foreignId('person_id')->constrained()->onDelete('cascade'); // BIGINT UNSIGNED NOT NULL
            $table->enum('type', ['like', 'dislike']); // ENUM('like','dislike') NOT NULL
            $table->timestamps(); // created_at TIMESTAMP
            
            // UNIQUE KEY user_person_unique (user_id, person_id)
            $table->unique(['user_id', 'person_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};