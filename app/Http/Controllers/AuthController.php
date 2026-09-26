<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $identifiants = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'L adresse e-mail est obligatoire.',
            'email.email' => 'L adresse e-mail doit être valide.',
            'password.required' => 'Le mot de passe est obligatoire.',
        ]);

        if (! Auth::attempt($identifiants, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'Les identifiants sont incorrects.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()
            ->intended(Auth::user()->can('administrer') ? route('admin.recettes.index') : route('recettes.index'))
            ->with('success', 'Connexion réussie.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('accueil')
            ->with('success', 'Déconnexion réussie.');
    }
}
