# BonApp

BonApp est une application web de recettes de cuisine réalisée avec Laravel dans le cadre de ma formation de Concepteur Développeur d'Applications.

Les visiteurs peuvent consulter les recettes publiées, les rechercher et les filtrer par catégorie. Un administrateur connecté peut gérer les recettes et les catégories.

Dépôt GitHub : https://github.com/sekouanehanine2022-cmd/bonapp

## Fonctionnalités

Partie publique :

- Page d'accueil.
- Liste des recettes publiées, affichées sous forme de cartes.
- Recherche par titre et filtre par catégorie en JavaScript.
- Page de détail d'une recette.

Administration (réservée à l'administrateur) :

- Connexion et déconnexion.
- Ajout, modification et suppression des recettes.
- Statut brouillon ou publiée (les brouillons ne sont pas visibles par les visiteurs).
- Ajout d'une photo pour chaque recette.
- Gestion des catégories (une catégorie utilisée par une recette ne peut pas être supprimée).

## Technologies

- PHP 8.2
- Laravel 12
- Blade
- Bootstrap 5
- JavaScript
- MySQL avec XAMPP et phpMyAdmin
- SQLite en mémoire pour les tests
- PHPUnit
- GitHub Actions

## Prérequis

- XAMPP installé, avec Apache et MySQL démarrés.
- Composer installé.
- PHP 8.2 disponible dans le terminal.
- Git.

## Installation

1. Récupérer le projet :

```powershell
cd C:\xampp\htdocs
git clone https://github.com/sekouanehanine2022-cmd/bonapp.git bonapp-laravel
cd bonapp-laravel
```

2. Installer les dépendances et créer le fichier `.env` :

```powershell
composer install
copy .env.example .env
php artisan key:generate
```

3. Créer une base de données nommée `bonapp_laravel` dans phpMyAdmin, puis modifier le fichier `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bonapp_laravel
DB_USERNAME=root
DB_PASSWORD=
```

4. Créer les tables et ajouter les données de démonstration :

```powershell
php artisan migrate:fresh --seed
```

Cette commande crée les tables et ajoute 2 comptes, 7 catégories et 12 recettes avec leurs photos.

5. Lancer le serveur :

```powershell
php artisan serve
```

Le site est accessible à l'adresse http://127.0.0.1:8000.

## Comptes de démonstration

Administrateur :

- E-mail : `admin@bonapp.local`
- Mot de passe : `bonapp123`

Utilisateur simple (sans accès à l'administration) :

- E-mail : `user@bonapp.local`
- Mot de passe : `bonapp123`

Ces comptes servent uniquement pour tester le projet en local. Il faut les changer avant une mise en ligne.

## Tests

```powershell
php artisan test
```

Les tests utilisent une base SQLite en mémoire (configurée dans `phpunit.xml`), ils ne modifient donc pas la base MySQL.

Les tests sont aussi lancés automatiquement sur GitHub à chaque envoi de code, grâce au fichier `.github/workflows/tests.yml`.

## Organisation du projet

- `app/Models` : modèles `User`, `Categorie` et `Recette`.
- `app/Http/Controllers` : contrôleurs des pages, de la connexion et de l'administration.
- `app/Http/Requests` : validation des formulaires.
- `app/Http/Middleware` : middleware qui protège l'administration.
- `resources/views` : vues Blade.
- `database/migrations` : création des tables `utilisateurs`, `categories` et `recettes`.
- `database/seeders` : données de démonstration et leurs photos (dossier `images`).
- `public/image` : logo et images du site.
- `public/image/recettes` : photos des recettes (non envoyées sur GitHub).
- `tests/Feature` : tests automatisés.

## Sécurité

- Le fichier `.env` n'est pas envoyé sur GitHub.
- Les mots de passe sont hachés.
- Les formulaires sont protégés contre les attaques CSRF avec `@csrf`.
- Les données affichées avec `{{ }}` sont protégées contre les attaques XSS.
- Les routes de l'administration sont protégées par les middlewares `auth` et `admin`.
- Les données des formulaires sont vérifiées côté serveur avec des `FormRequest`.
- Les photos sont vérifiées avant l'enregistrement (JPG, PNG ou WebP, 2 Mo maximum).

## En cas de problème

Vider les caches de Laravel :

```powershell
php artisan optimize:clear
```
