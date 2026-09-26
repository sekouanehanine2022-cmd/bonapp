<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategorieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('administrer') ?? false;
    }

    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'max:80'],
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom de la catégorie est obligatoire.',
            'description.max' => 'La description ne doit pas dépasser 255 caractères.',
        ];
    }
}
