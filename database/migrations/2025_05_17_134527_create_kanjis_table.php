<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kanjis', function (Blueprint $table) {
            $table->id();
            $table->string('character');
            $table->string('onyomi')->nullable(); // bacaan On
            $table->string('kunyomi')->nullable(); // bacaan Kun
            $table->string('meaning');
            $table->string('category');
            $table->string('level')->nullable(); // JLPT level
            $table->text('hint')->nullable(); // bisa menyimpan contoh penggunaan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kanjis');
    }
};
