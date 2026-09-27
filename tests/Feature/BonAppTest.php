<?php

namespace Tests\Feature;

use App\Models\Categorie;
use App\Models\Recette;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BonAppTest extends TestCase
{
    use RefreshDatabase;

    public function test_la_page_publique_des_recettes_est_accessible(): void
    {
        // Vérifie que le catalogue public répond correctement.
        $response = $this->get(route('recettes.index'));

        $response->assertOk();
        $response->assertSee('Toutes nos recettes');
    }

    public function test_les_recettes_publiees_sont_affichees(): void
    {
        // Une recette publiée doit être visible dans le catalogue public.
        $recette = Recette::factory()->publiee()->create([
            'titre' => 'Recette publiée visible',
        ]);

        $response = $this->get(route('recettes.index'));

        $response->assertOk();
        $response->assertSee($recette->titre);
    }

    public function test_les_recettes_en_brouillon_ne_sont_pas_affichees(): void
    {
        // Une recette en brouillon ne doit pas apparaître côté public.
        $recette = Recette::factory()->brouillon()->create([
            'titre' => 'Recette brouillon cachee',
        ]);

        $response = $this->get(route('recettes.index'));

        $response->assertOk();
        $response->assertDontSee($recette->titre);
    }

    public function test_un_visiteur_non_connecte_est_redirige_depuis_l_administration(): void
    {
        // Les routes d’administration exigent une connexion.
        $response = $this->get(route('admin.recettes.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_un_administrateur_peut_se_connecter_avec_des_identifiants_valides(): void
    {
        // Le compte administrateur valide ouvre une session Laravel.
        $admin = User::factory()->admin()->create([
            'email' => 'admin.test@bonapp.local',
            'password' => 'motdepasse',
        ]);

        $response = $this->post(route('login.store'), [
            'email' => 'admin.test@bonapp.local',
            'password' => 'motdepasse',
        ]);

        $response->assertRedirect(route('admin.recettes.index'));
        $this->assertAuthenticatedAs($admin);
    }

    public function test_la_connexion_est_refusee_avec_un_mauvais_mot_de_passe(): void
    {
        // Un mauvais mot de passe ne doit pas connecter l’utilisateur.
        User::factory()->admin()->create([
            'email' => 'admin.test@bonapp.local',
            'password' => 'motdepasse',
        ]);

        $response = $this->post(route('login.store'), [
            'email' => 'admin.test@bonapp.local',
            'password' => 'erreur',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_le_formulaire_recette_valide_les_champs_obligatoires(): void
    {
        // Une création incomplète doit renvoyer des erreurs de validation.
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->post(route('admin.recettes.store'), [
            'description' => 'Description sans titre.',
        ]);

        $response->assertSessionHasErrors([
            'titre',
            'categorie_id',
            'ingredients',
            'instructions',
            'temps_preparation',
            'nombre_personnes',
            'difficulte',
            'statut',
        ]);
    }

    public function test_un_administrateur_connecte_peut_creer_une_recette(): void
    {
        // L’administrateur peut ajouter une recette complète.
        $admin = User::factory()->admin()->create();
        $categorie = Categorie::factory()->create();

        $response = $this->actingAs($admin)->post(route('admin.recettes.store'), $this->donneesRecette([
            'categorie_id' => $categorie->id,
            'titre' => 'Tarte aux pommes',
        ]));

        $response->assertRedirect(route('admin.recettes.index'));
        $this->assertDatabaseHas('recettes', [
            'titre' => 'Tarte aux pommes',
            'utilisateur_id' => $admin->id,
            'categorie_id' => $categorie->id,
        ]);
    }

    public function test_un_administrateur_connecte_peut_modifier_une_recette(): void
    {
        // La modification met bien à jour les données en base de test.
        $admin = User::factory()->admin()->create();
        $recette = Recette::factory()->create(['utilisateur_id' => $admin->id]);
        $nouvelleCategorie = Categorie::factory()->create();

        $response = $this->actingAs($admin)->put(route('admin.recettes.update', $recette), $this->donneesRecette([
            'categorie_id' => $nouvelleCategorie->id,
            'titre' => 'Recette modifiée',
            'statut' => 'brouillon',
        ]));

        $response->assertRedirect(route('admin.recettes.index'));
        $this->assertDatabaseHas('recettes', [
            'id' => $recette->id,
            'titre' => 'Recette modifiée',
            'statut' => 'brouillon',
        ]);
    }

    public function test_un_administrateur_connecte_peut_supprimer_une_recette(): void
    {
        // La suppression retire la recette de la base de test.
        $admin = User::factory()->admin()->create();
        $recette = Recette::factory()->create(['utilisateur_id' => $admin->id]);

        $response = $this->actingAs($admin)->delete(route('admin.recettes.destroy', $recette));

        $response->assertRedirect(route('admin.recettes.index'));
        $this->assertDatabaseMissing('recettes', ['id' => $recette->id]);
    }

    private function donneesRecette(array $remplacements = []): array
    {
        return array_merge([
            'titre' => 'Recette de test',
            'categorie_id' => Categorie::factory()->create()->id,
            'description' => 'Une recette fictive utilisée uniquement pendant les tests.',
            'ingredients' => "Farine\nEau\nSel",
            'instructions' => "Mélanger.\nCuire.\nServir.",
            'temps_preparation' => 30,
            'nombre_personnes' => 4,
            'difficulte' => 'facile',
            'statut' => 'publiee',
        ], $remplacements);
    }
}
