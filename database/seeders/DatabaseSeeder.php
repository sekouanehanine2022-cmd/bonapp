<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Recette;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin BonApp',
            'email' => 'admin@bonapp.local',
            'password' => Hash::make('bonapp123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Utilisateur BonApp',
            'email' => 'user@bonapp.local',
            'password' => Hash::make('bonapp123'),
            'role' => 'user',
        ]);

        $categories = collect([
            'entree' => ['nom' => 'Entrée', 'description' => 'Recettes pour commencer le repas.'],
            'plat' => ['nom' => 'Plat', 'description' => 'Plats principaux simples et gourmands.'],
            'dessert' => ['nom' => 'Dessert', 'description' => 'Recettes sucrées pour finir le repas.'],
            'soupe' => ['nom' => 'Soupe', 'description' => 'Soupes et veloutés maison.'],
            'petit_dejeuner' => ['nom' => 'Petit-déjeuner', 'description' => 'Idées pour bien commencer la journée.'],
            'viande' => ['nom' => 'Viande', 'description' => 'Recettes avec viande.'],
            'boisson' => ['nom' => 'Boisson', 'description' => 'Boissons froides ou chaudes.'],
        ])->map(fn (array $categorie): Categorie => Categorie::create($categorie));

        $recettes = [
            ['Pâtes à la carbonara', 'plat', 'Un grand classique italien rapide et gourmand.', 'recette1.jpg', 25, 4, 'facile'],
            ['Gâteau au chocolat fondant', 'dessert', 'Un gâteau au chocolat riche et moelleux.', 'recette2.jpg', 45, 8, 'moyen'],
            ['Salade Caesar fraîche', 'entree', 'Une salade classique et croquante avec une sauce maison.', 'recette3.jpg', 25, 4, 'facile'],
            ['Poulet grillé aux herbes', 'viande', 'Des blancs de poulet marinés aux herbes aromatiques.', 'recette4.jpg', 45, 4, 'facile'],
            ['Soupe à l oignon gratinée', 'soupe', 'Une soupe française réconfortante avec du fromage gratiné.', 'recette5.jpg', 80, 6, 'facile'],
            ['Pain perdu gourmand', 'petit_dejeuner', 'Un petit-déjeuner classique et délicieux.', 'recette6.jpg', 25, 4, 'facile'],
            ['Soupe de tomates maison', 'soupe', 'Une soupe de tomates crémeuse et réconfortante.', 'recette7.jpg', 40, 4, 'facile'],
            ['Boeuf Wellington', 'viande', 'Un plat britannique avec filet de boeuf enrobé de pâte feuilletée.', 'recette8.jpg', 105, 6, 'difficile'],
            ['Soufflé au chocolat', 'dessert', 'Un dessert français léger et aérien.', 'recette9.jpg', 45, 6, 'difficile'],
            ['Paella aux fruits de mer', 'plat', 'Un plat espagnol parfumé au safran.', 'recette10.jpg', 85, 8, 'difficile'],
            ['Citronnade maison rafraîchissante', 'boisson', 'Une boisson fraîche et désaltérante.', 'recette11.jpg', 15, 2, 'facile'],
            ['Smoothie tropical vitaminé', 'boisson', 'Un smoothie frais et crémeux aux fruits tropicaux.', 'recette12.jpg', 5, 2, 'facile'],
        ];

        // les photos sont copiées dans image/recettes, comme si l'admin les avait ajoutées
        File::ensureDirectoryExists(public_path('image/recettes'));

        foreach ($recettes as [$titre, $categorieCle, $description, $image, $temps, $personnes, $difficulte]) {
            File::copy(database_path('seeders/images/'.$image), public_path('image/recettes/'.$image));

            Recette::create([
                'user_id' => $admin->id,
                'categorie_id' => $categories[$categorieCle]->id,
                'titre' => $titre,
                'description' => $description,
                'ingredients' => "Ingrédients principaux\nAssaisonnement\nAccompagnement selon la recette",
                'instructions' => "Préparer les ingrédients.\nCuire selon la recette.\nServir chaud ou frais selon le plat.",
                'image' => 'image/recettes/'.$image,
                'temps_preparation' => $temps,
                'nombre_personnes' => $personnes,
                'difficulte' => $difficulte,
                'statut' => 'publiee',
            ]);
        }
    }
}
