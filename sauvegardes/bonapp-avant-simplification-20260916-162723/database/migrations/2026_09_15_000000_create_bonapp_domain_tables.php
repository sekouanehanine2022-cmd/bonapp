<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 50)->unique();
            $table->string('description')->nullable();
        });

        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles')->cascadeOnUpdate();
            $table->string('prenom', 80);
            $table->string('nom', 80);
            $table->string('email', 190)->unique();
            $table->string('mot_de_passe_hash');
            $table->string('telephone', 30)->nullable();
            $table->enum('statut', ['actif', 'bloque', 'supprime'])->default('actif');
            $table->timestamps();
        });

        Schema::create('profils_clients', function (Blueprint $table) {
            $table->foreignId('utilisateur_id')->primary()->constrained('utilisateurs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('date_naissance')->nullable();
            $table->enum('niveau_cuisine', ['debutant', 'intermediaire', 'avance'])->default('debutant');
            $table->text('bio')->nullable();
            $table->text('preferences_alimentaires')->nullable();
            $table->timestamps();
        });

        Schema::create('adresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('utilisateurs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('libelle', 80);
            $table->string('ligne1', 190);
            $table->string('ligne2', 190)->nullable();
            $table->string('ville', 100);
            $table->string('code_postal', 20);
            $table->string('pays', 80)->default('France');
            $table->boolean('principale')->default(false);
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('categories')->nullOnDelete()->cascadeOnUpdate();
            $table->string('nom', 80);
            $table->string('slug', 100)->unique();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('recettes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auteur_id')->constrained('utilisateurs')->cascadeOnUpdate();
            $table->string('titre', 150);
            $table->string('slug', 180)->unique();
            $table->text('description');
            $table->text('ingredients');
            $table->text('instructions');
            $table->string('image')->default('image/recette1.jpg');
            $table->string('temps', 50);
            $table->string('personnes', 50);
            $table->string('type', 80);
            $table->enum('niveau', ['facile', 'moyen', 'difficile'])->default('facile');
            $table->string('categories')->default('');
            $table->unsignedSmallInteger('temps_preparation_min')->nullable();
            $table->unsignedSmallInteger('temps_cuisson_min')->nullable();
            $table->unsignedSmallInteger('portions')->nullable();
            $table->decimal('cout_estime', 8, 2)->nullable();
            $table->enum('statut', ['brouillon', 'publiee', 'archivee'])->default('publiee');
            $table->timestamps();
        });

        Schema::create('recette_categories', function (Blueprint $table) {
            $table->foreignId('recette_id')->constrained('recettes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('categorie_id')->constrained('categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['recette_id', 'categorie_id']);
        });

        Schema::create('unites', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 50)->unique();
            $table->string('abreviation', 20)->unique();
        });

        Schema::create('ingredients_catalogue', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100)->unique();
            $table->string('slug', 120)->unique();
            $table->string('type', 80)->nullable();
            $table->timestamps();
        });

        Schema::create('allergenes', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 80)->unique();
            $table->string('description')->nullable();
        });

        Schema::create('ingredient_allergenes', function (Blueprint $table) {
            $table->foreignId('ingredient_id')->constrained('ingredients_catalogue')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('allergene_id')->constrained('allergenes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['ingredient_id', 'allergene_id']);
        });

        Schema::create('utilisateur_allergenes', function (Blueprint $table) {
            $table->foreignId('utilisateur_id')->constrained('utilisateurs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('allergene_id')->constrained('allergenes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['utilisateur_id', 'allergene_id']);
        });

        Schema::create('recette_ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recette_id')->constrained('recettes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('ingredient_id')->constrained('ingredients_catalogue')->cascadeOnUpdate();
            $table->foreignId('unite_id')->nullable()->constrained('unites')->nullOnDelete()->cascadeOnUpdate();
            $table->decimal('quantite', 10, 2)->nullable();
            $table->string('note', 120)->nullable();
            $table->unsignedSmallInteger('ordre')->default(1);
            $table->timestamps();
        });

        Schema::create('etapes_recette', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recette_id')->constrained('recettes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedSmallInteger('numero');
            $table->text('description');
            $table->unsignedSmallInteger('duree_min')->nullable();
            $table->timestamps();
            $table->unique(['recette_id', 'numero']);
        });

        Schema::create('medias_recette', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recette_id')->constrained('recettes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('url');
            $table->enum('type_media', ['image', 'video'])->default('image');
            $table->string('texte_alternatif', 150)->nullable();
            $table->boolean('principale')->default(false);
            $table->timestamps();
        });

        Schema::create('avis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recette_id')->constrained('recettes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('utilisateur_id')->constrained('utilisateurs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedTinyInteger('note');
            $table->text('commentaire')->nullable();
            $table->timestamps();
            $table->unique(['recette_id', 'utilisateur_id']);
        });

        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recette_id')->constrained('recettes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('utilisateur_id')->constrained('utilisateurs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('parent_id')->nullable()->constrained('commentaires')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('contenu');
            $table->enum('statut', ['visible', 'masque', 'signale'])->default('visible');
            $table->timestamps();
        });

        Schema::create('favoris', function (Blueprint $table) {
            $table->foreignId('utilisateur_id')->constrained('utilisateurs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('recette_id')->constrained('recettes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
            $table->primary(['utilisateur_id', 'recette_id']);
        });

        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('utilisateurs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nom', 100);
            $table->string('description')->nullable();
            $table->enum('visibilite', ['privee', 'publique'])->default('privee');
            $table->timestamps();
        });

        Schema::create('collection_recettes', function (Blueprint $table) {
            $table->foreignId('collection_id')->constrained('collections')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('recette_id')->constrained('recettes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
            $table->primary(['collection_id', 'recette_id']);
        });

        Schema::create('planifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('utilisateurs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nom', 100);
            $table->date('date_debut');
            $table->date('date_fin');
            $table->timestamps();
        });

        Schema::create('repas_planifies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('planification_id')->constrained('planifications')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('recette_id')->constrained('recettes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('date_repas');
            $table->enum('type_repas', ['petit_dejeuner', 'dejeuner', 'diner', 'collation']);
            $table->unsignedSmallInteger('portions')->default(1);
            $table->timestamps();
        });

        Schema::create('listes_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('utilisateurs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('planification_id')->nullable()->constrained('planifications')->nullOnDelete()->cascadeOnUpdate();
            $table->string('nom', 100);
            $table->enum('statut', ['ouverte', 'terminee', 'archivee'])->default('ouverte');
            $table->timestamps();
        });

        Schema::create('liste_courses_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('liste_id')->constrained('listes_courses')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('ingredient_id')->nullable()->constrained('ingredients_catalogue')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('unite_id')->nullable()->constrained('unites')->nullOnDelete()->cascadeOnUpdate();
            $table->string('libelle', 120);
            $table->decimal('quantite', 10, 2)->nullable();
            $table->boolean('coche')->default(false);
            $table->unsignedSmallInteger('ordre')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('liste_courses_items');
        Schema::dropIfExists('listes_courses');
        Schema::dropIfExists('repas_planifies');
        Schema::dropIfExists('planifications');
        Schema::dropIfExists('collection_recettes');
        Schema::dropIfExists('collections');
        Schema::dropIfExists('favoris');
        Schema::dropIfExists('commentaires');
        Schema::dropIfExists('avis');
        Schema::dropIfExists('medias_recette');
        Schema::dropIfExists('etapes_recette');
        Schema::dropIfExists('recette_ingredients');
        Schema::dropIfExists('utilisateur_allergenes');
        Schema::dropIfExists('ingredient_allergenes');
        Schema::dropIfExists('allergenes');
        Schema::dropIfExists('ingredients_catalogue');
        Schema::dropIfExists('unites');
        Schema::dropIfExists('recette_categories');
        Schema::dropIfExists('recettes');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('adresses');
        Schema::dropIfExists('profils_clients');
        Schema::dropIfExists('utilisateurs');
        Schema::dropIfExists('roles');
    }
};
