<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        DB::table('roles')->insert([
            ['id' => 1, 'nom' => 'admin', 'description' => 'Gere les recettes, les utilisateurs et la moderation.'],
            ['id' => 2, 'nom' => 'client', 'description' => 'Consulte, note, commente, sauvegarde et planifie des recettes.'],
            ['id' => 3, 'nom' => 'chef', 'description' => 'Publie et gere ses propres recettes.'],
        ]);

        DB::table('utilisateurs')->insert([
            ['id' => 1, 'role_id' => 1, 'prenom' => 'Admin', 'nom' => 'BonApp', 'email' => 'admin@bonapp.local', 'mot_de_passe_hash' => Hash::make('password'), 'telephone' => null, 'statut' => 'actif', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'role_id' => 2, 'prenom' => 'Leila', 'nom' => 'Martin', 'email' => 'leila.client@bonapp.local', 'mot_de_passe_hash' => Hash::make('password'), 'telephone' => '0600000001', 'statut' => 'actif', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'role_id' => 2, 'prenom' => 'Nassim', 'nom' => 'Bernard', 'email' => 'nassim.client@bonapp.local', 'mot_de_passe_hash' => Hash::make('password'), 'telephone' => '0600000002', 'statut' => 'actif', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'role_id' => 3, 'prenom' => 'Camille', 'nom' => 'Durand', 'email' => 'camille.chef@bonapp.local', 'mot_de_passe_hash' => Hash::make('password'), 'telephone' => null, 'statut' => 'actif', 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('profils_clients')->insert([
            ['utilisateur_id' => 2, 'date_naissance' => '1998-05-14', 'niveau_cuisine' => 'debutant', 'bio' => 'Aime les recettes rapides pour la semaine.', 'preferences_alimentaires' => 'healthy, facile, sans porc', 'created_at' => $now, 'updated_at' => $now],
            ['utilisateur_id' => 3, 'date_naissance' => '1995-11-22', 'niveau_cuisine' => 'intermediaire', 'bio' => 'Cuisine souvent pour sa famille.', 'preferences_alimentaires' => 'plats familiaux, desserts', 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('categories')->insert([
            ['id' => 1, 'parent_id' => null, 'nom' => 'Entrée', 'slug' => 'entree', 'description' => 'Recettes pour commencer le repas.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'parent_id' => null, 'nom' => 'Plat', 'slug' => 'plat', 'description' => 'Plats principaux.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'parent_id' => null, 'nom' => 'Dessert', 'slug' => 'dessert', 'description' => 'Recettes sucrees.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'parent_id' => null, 'nom' => 'Soupe', 'slug' => 'soupe', 'description' => 'Soupes et veloutes.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'parent_id' => null, 'nom' => 'Petit-Déjeuner', 'slug' => 'petit-dejeuner', 'description' => 'Idees pour le matin.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'parent_id' => null, 'nom' => 'Viande', 'slug' => 'viande', 'description' => 'Recettes avec viande.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 7, 'parent_id' => null, 'nom' => 'Healthy', 'slug' => 'healthy', 'description' => 'Recettes equilibrees.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 8, 'parent_id' => null, 'nom' => 'Boisson', 'slug' => 'boisson', 'description' => 'Boissons froides ou chaudes.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 9, 'parent_id' => null, 'nom' => 'Facile', 'slug' => 'facile', 'description' => 'Recettes simples a realiser.', 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('unites')->insert([
            ['id' => 1, 'nom' => 'gramme', 'abreviation' => 'g'],
            ['id' => 2, 'nom' => 'kilogramme', 'abreviation' => 'kg'],
            ['id' => 3, 'nom' => 'millilitre', 'abreviation' => 'ml'],
            ['id' => 4, 'nom' => 'litre', 'abreviation' => 'L'],
            ['id' => 5, 'nom' => 'piece', 'abreviation' => 'pc'],
        ]);

        DB::table('ingredients_catalogue')->insert([
            ['id' => 1, 'nom' => 'Spaghetti', 'slug' => 'spaghetti', 'type' => 'feculent', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'nom' => 'Pancetta', 'slug' => 'pancetta', 'type' => 'viande', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'nom' => 'Oeuf', 'slug' => 'oeuf', 'type' => 'proteine', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'nom' => 'Parmesan', 'slug' => 'parmesan', 'type' => 'fromage', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'nom' => 'Poulet', 'slug' => 'poulet', 'type' => 'viande', 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('allergenes')->insert([
            ['id' => 1, 'nom' => 'Oeufs', 'description' => 'Produits contenant des oeufs.'],
            ['id' => 2, 'nom' => 'Lait', 'description' => 'Produits laitiers.'],
            ['id' => 3, 'nom' => 'Gluten', 'description' => 'Ble, farine et produits derives.'],
        ]);

        DB::table('ingredient_allergenes')->insert([
            ['ingredient_id' => 1, 'allergene_id' => 3],
            ['ingredient_id' => 3, 'allergene_id' => 1],
            ['ingredient_id' => 4, 'allergene_id' => 2],
        ]);

        DB::table('utilisateur_allergenes')->insert([
            ['utilisateur_id' => 2, 'allergene_id' => 3],
        ]);

        $recettes = [
            [1, 'Pâtes à la Carbonara', 'pates-a-la-carbonara', 'Un grand classique italien rapide et gourmand.', 'image/recette1.jpg', '25 min', '4 personnes', 'Plat', 'facile', 'Plat Facile Healthy'],
            [2, 'Gâteau au Chocolat Fondant', 'gateau-au-chocolat-fondant', 'Un gâteau au chocolat riche et moelleux.', 'image/recette2.jpg', '45 min', '8 personnes', 'Dessert', 'moyen', 'Dessert'],
            [3, 'Salade Caesar Fraîche', 'salade-caesar-fraiche', 'Une salade classique et croquante avec une sauce maison.', 'image/recette3.jpg', '25 min', '4 personnes', 'Entrée', 'facile', 'Entrée Healthy Facile'],
            [4, 'Poulet Grillé aux Herbes', 'poulet-grille-aux-herbes', 'Des blancs de poulet marinés aux herbes aromatiques.', 'image/recette4.jpg', '45 min', '4 personnes', 'Viande', 'facile', 'Plat Facile Healthy Viande'],
            [5, 'Soupe à l\'Oignon Gratinée', 'soupe-a-l-oignon-gratinee', 'Une soupe française réconfortante avec du fromage gratiné.', 'image/recette5.jpg', '80 min', '6 personnes', 'Soupe', 'facile', 'Plat Entrée Healthy Soupe'],
            [6, 'Pain Perdu Gourmand', 'pain-perdu-gourmand', 'Un petit-déjeuner classique et délicieux.', 'image/recette6.jpg', '25 min', '4 personnes', 'Petit Déjeuner', 'facile', 'Petit-Déjeuner Facile'],
            [7, 'Soupe de Tomates Maison', 'soupe-de-tomates-maison', 'Une soupe de tomates crémeuse et réconfortante.', 'image/recette7.jpg', '40 min', '4 personnes', 'Soupe', 'facile', 'Plat Entrée Facile Soupe'],
            [8, 'Boeuf Wellington', 'boeuf-wellington', 'Un plat britannique avec filet de boeuf enrobé de pâte feuilletée.', 'image/recette8.jpg', '105 min', '6 personnes', 'Viande', 'difficile', 'Plat Viande'],
            [9, 'Soufflé au Chocolat', 'souffle-au-chocolat', 'Un dessert français léger et aérien.', 'image/recette9.jpg', '45 min', '6 personnes', 'Dessert', 'difficile', 'Dessert'],
            [10, 'Paella aux Fruits de Mer', 'paella-aux-fruits-de-mer', 'Un plat espagnol parfumé au safran.', 'image/recette10.jpg', '85 min', '8 personnes', 'Plat', 'difficile', 'Plat Healthy'],
            [11, 'Citronnade Maison Rafraîchissante', 'citronnade-maison-rafraichissante', 'Une boisson fraîche et désaltérante.', 'image/recette11.jpg', '15 min', '2 personnes', 'Boisson', 'facile', 'Boisson'],
            [12, 'Smoothie Tropical Vitaminé', 'smoothie-tropical-vitamine', 'Un smoothie frais et crémeux aux fruits tropicaux.', 'image/recette12.jpg', '5 min', '2 personnes', 'Boisson', 'facile', 'Boisson Healthy Facile'],
        ];

        foreach ($recettes as [$id, $titre, $slug, $description, $image, $temps, $personnes, $type, $niveau, $categories]) {
            DB::table('recettes')->insert([
                'id' => $id,
                'auteur_id' => 4,
                'titre' => $titre,
                'slug' => $slug,
                'description' => $description,
                'ingredients' => "1. Ingrédients principaux\n2. Assaisonnement\n3. Accompagnement",
                'instructions' => "1. Préparer les ingrédients.\n2. Cuire selon la recette.\n3. Servir.",
                'image' => $image,
                'temps' => $temps,
                'personnes' => $personnes,
                'type' => $type,
                'niveau' => $niveau,
                'categories' => $categories,
                'temps_preparation_min' => null,
                'temps_cuisson_min' => null,
                'portions' => null,
                'cout_estime' => null,
                'statut' => 'publiee',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        DB::table('recette_categories')->insert([
            ['recette_id' => 1, 'categorie_id' => 2], ['recette_id' => 1, 'categorie_id' => 7], ['recette_id' => 1, 'categorie_id' => 9],
            ['recette_id' => 2, 'categorie_id' => 3],
            ['recette_id' => 3, 'categorie_id' => 1], ['recette_id' => 3, 'categorie_id' => 7], ['recette_id' => 3, 'categorie_id' => 9],
            ['recette_id' => 4, 'categorie_id' => 2], ['recette_id' => 4, 'categorie_id' => 6], ['recette_id' => 4, 'categorie_id' => 7], ['recette_id' => 4, 'categorie_id' => 9],
            ['recette_id' => 5, 'categorie_id' => 2], ['recette_id' => 5, 'categorie_id' => 4],
            ['recette_id' => 6, 'categorie_id' => 5], ['recette_id' => 6, 'categorie_id' => 9],
            ['recette_id' => 7, 'categorie_id' => 2], ['recette_id' => 7, 'categorie_id' => 4], ['recette_id' => 7, 'categorie_id' => 9],
            ['recette_id' => 8, 'categorie_id' => 2], ['recette_id' => 8, 'categorie_id' => 6],
            ['recette_id' => 9, 'categorie_id' => 3],
            ['recette_id' => 10, 'categorie_id' => 2], ['recette_id' => 10, 'categorie_id' => 7],
            ['recette_id' => 11, 'categorie_id' => 8],
            ['recette_id' => 12, 'categorie_id' => 8], ['recette_id' => 12, 'categorie_id' => 7], ['recette_id' => 12, 'categorie_id' => 9],
        ]);

        DB::table('recette_ingredients')->insert([
            ['recette_id' => 1, 'ingredient_id' => 1, 'unite_id' => 1, 'quantite' => 400, 'note' => null, 'ordre' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['recette_id' => 1, 'ingredient_id' => 2, 'unite_id' => 1, 'quantite' => 200, 'note' => null, 'ordre' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['recette_id' => 1, 'ingredient_id' => 3, 'unite_id' => 5, 'quantite' => 4, 'note' => null, 'ordre' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['recette_id' => 4, 'ingredient_id' => 5, 'unite_id' => 5, 'quantite' => 4, 'note' => 'blancs de poulet', 'ordre' => 1, 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('avis')->insert([
            ['recette_id' => 1, 'utilisateur_id' => 2, 'note' => 5, 'commentaire' => 'Simple et tres bon pour un soir de semaine.', 'created_at' => $now, 'updated_at' => $now],
            ['recette_id' => 2, 'utilisateur_id' => 3, 'note' => 4, 'commentaire' => 'Fondant reussi, cuisson a surveiller.', 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('favoris')->insert([
            ['utilisateur_id' => 2, 'recette_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['utilisateur_id' => 2, 'recette_id' => 4, 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('planifications')->insert([
            ['id' => 1, 'utilisateur_id' => 2, 'nom' => 'Menu semaine', 'date_debut' => '2026-09-14', 'date_fin' => '2026-09-20', 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('repas_planifies')->insert([
            ['planification_id' => 1, 'recette_id' => 1, 'date_repas' => '2026-09-15', 'type_repas' => 'diner', 'portions' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['planification_id' => 1, 'recette_id' => 3, 'date_repas' => '2026-09-16', 'type_repas' => 'dejeuner', 'portions' => 2, 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('listes_courses')->insert([
            ['id' => 1, 'utilisateur_id' => 2, 'planification_id' => 1, 'nom' => 'Courses menu semaine', 'statut' => 'ouverte', 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('liste_courses_items')->insert([
            ['liste_id' => 1, 'ingredient_id' => 1, 'unite_id' => 1, 'libelle' => 'Spaghetti', 'quantite' => 400, 'coche' => false, 'ordre' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['liste_id' => 1, 'ingredient_id' => 5, 'unite_id' => 5, 'libelle' => 'Blancs de poulet', 'quantite' => 4, 'coche' => false, 'ordre' => 2, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
