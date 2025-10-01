<?php
// database/migrations/2025_01_01_000002_create_pictures_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pictures', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->foreignId('person_id')->constrained()->onDelete('cascade'); // BIGINT UNSIGNED NOT NULL with foreign key
            $table->string('url', 512); // VARCHAR(512) NOT NULL
            $table->unsignedTinyInteger('position')->default(0); // TINYINT UNSIGNED DEFAULT 0
            $table->timestamps(); // created_at & updated_at TIMESTAMP
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pictures');
    }
};