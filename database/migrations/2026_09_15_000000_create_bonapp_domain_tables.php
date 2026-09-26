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
            $table->string('nom', 80);
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('recettes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('categorie_id')->constrained('categories')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('titre', 150);
            $table->text('description');
            $table->text('ingredients');
            $table->text('instructions');
            $table->string('image')->nullable();
            $table->unsignedSmallInteger('temps_preparation');
            $table->unsignedSmallInteger('nombre_personnes');
            $table->enum('difficulte', ['facile', 'moyen', 'difficile'])->default('facile');
            $table->enum('statut', ['brouillon', 'publiee'])->default('brouillon');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recettes');
        Schema::dropIfExists('categories');
    }
};
