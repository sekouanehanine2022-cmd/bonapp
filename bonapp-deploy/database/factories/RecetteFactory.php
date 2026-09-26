<?php

namespace Database\Factories;

use App\Models\Categorie;
use App\Models\Recette;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Recette>
 */
class RecetteFactory extends Factory
{
    protected $model = Recette::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->admin(),
            'categorie_id' => Categorie::factory(),
            'titre' => fake()->unique()->sentence(3),
            'description' => fake()->paragraph(),
            'ingredients' => "Farine\nEau\nSel",
            'instructions' => "Préparer les ingrédients.\nCuire la recette.\nServir.",
            'image' => 'image/recette1.jpg',
            'temps_preparation' => fake()->numberBetween(10, 90),
            'nombre_personnes' => fake()->numberBetween(1, 8),
            'difficulte' => fake()->randomElement(['facile', 'moyen', 'difficile']),
            'statut' => 'publiee',
        ];
    }

    public function publiee(): static
    {
        return $this->state(fn (): array => ['statut' => 'publiee']);
    }

    public function brouillon(): static
    {
        return $this->state(fn (): array => ['statut' => 'brouillon']);
    }
}
