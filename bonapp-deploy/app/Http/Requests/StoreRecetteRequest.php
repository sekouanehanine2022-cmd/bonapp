<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRecetteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('administrer') ?? false;
    }

    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:150'],
            'categorie_id' => ['required', 'exists:categories,id'],
            'description' => ['required', 'string'],
            'ingredients' => ['required', 'string'],
            'instructions' => ['required', 'string'],
            'temps_preparation' => ['required', 'integer', 'min:1'],
            'nombre_personnes' => ['required', 'integer', 'min:1'],
            'difficulte' => ['required', Rule::in(['facile', 'moyen', 'difficile'])],
            'statut' => ['required', Rule::in(['brouillon', 'publiee'])],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre est obligatoire.',
            'categorie_id.required' => 'La catégorie est obligatoire.',
            'categorie_id.exists' => 'La catégorie choisie est invalide.',
            'description.required' => 'La description est obligatoire.',
            'ingredients.required' => 'Les ingrédients sont obligatoires.',
            'instructions.required' => 'Les instructions sont obligatoires.',
            'temps_preparation.required' => 'Le temps de préparation est obligatoire.',
            'temps_preparation.integer' => 'Le temps de préparation doit être un nombre entier.',
            'temps_preparation.min' => 'Le temps de préparation doit être positif.',
            'nombre_personnes.required' => 'Le nombre de personnes est obligatoire.',
            'nombre_personnes.integer' => 'Le nombre de personnes doit être un nombre entier.',
            'nombre_personnes.min' => 'Le nombre de personnes doit être positif.',
            'difficulte.required' => 'La difficulté est obligatoire.',
            'difficulte.in' => 'La difficulté choisie est invalide.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut choisi est invalide.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L image doit être au format JPG, JPEG, PNG ou WebP.',
            'image.max' => 'L image ne doit pas dépasser 2 Mo.',
        ];
    }
}
