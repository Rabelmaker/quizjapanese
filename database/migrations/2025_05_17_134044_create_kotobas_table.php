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
        Schema::create('kotobas', function (Blueprint $table) {
            $table->id();
            $table->string('japanese');
            $table->string('reading');
            $table->string('meaning');
            $table->string('category'); // Misalnya: Greetings, Verbs, etc.
            $table->string('level')->nullable(); // Misalnya: JLPT N5, JLPT N4, Daily Life
            $table->string('hint')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kotobas');
    }
};
