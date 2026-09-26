# BonApp

BonApp est une application Laravel simple de gestion de recettes. Elle sert de support pour un dossier professionnel de Concepteur Développeur d’Applications.

## Fonctionnalités

- Page d’accueil.
- Liste des recettes publiées.
- Recherche JavaScript par titre.
- Filtre par catégorie.
- Page de détail d’une recette.
- Connexion et déconnexion.
- Administration protégée par rôle.
- Ajout, modification et suppression des recettes.
- Gestion des catégories.
- Tests Feature avec `RefreshDatabase`.

## Technologies

- PHP 8.2.
- Laravel 12.
- Blade.
- Bootstrap 5.
- MySQL avec XAMPP/phpMyAdmin.
- SQLite pour les tests automatisés.

## Prérequis Windows avec XAMPP

- XAMPP installé.
- Apache et MySQL démarrés.
- Composer installé.
- PHP disponible dans le terminal.

## Installation

Créer une base MySQL nommée `bonapp` dans phpMyAdmin, puis configurer le fichier `.env`.

```powershell
cd C:\xampp\htdocs\bonapp-laravel
copy .env.example .env
composer install
php artisan key:generate
```

Exemple de configuration MySQL :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bonapp
DB_USERNAME=root
DB_PASSWORD=
```

Créer les tables et les données de démonstration :

```powershell
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve
```

Adresse locale :

```text
http://127.0.0.1:8000
```

## Tests

```powershell
php artisan test
```

Les tests utilisent SQLite en mémoire grâce à `phpunit.xml`.

## Identifiants de démonstration

Administrateur :

- E-mail : `admin@bonapp.local`
- Mot de passe : `bonapp123`

Utilisateur normal :

- E-mail : `user@bonapp.local`
- Mot de passe : `bonapp123`

Ces identifiants sont uniquement prévus pour la démonstration. Ils doivent être changés avant une vraie mise en production.

## Structure principale

- `app/Models` : modèles `User`, `Categorie`, `Recette`.
- `app/Http/Controllers` : contrôleurs des pages, de l’authentification et de l’administration.
- `app/Http/Requests` : validation des formulaires.
- `resources/views` : vues Blade.
- `database/migrations` : structure de la base.
- `database/seeders` : données de démonstration.
- `tests/Feature` : tests automatisés.
- `docs` : documents pour le dossier professionnel.

## Sécurité

- Le fichier `.env` est ignoré par Git.
- Les mots de passe sont hachés avec `Hash::make`.
- Les formulaires utilisent la protection CSRF.
- Les routes d’administration utilisent les middlewares `auth` et `admin`.
- Les données sont validées côté serveur avec des `FormRequest`.
- Les images sont validées avant stockage.

## Nettoyage des caches

```powershell
php artisan optimize:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Documentation

Les documents utiles au dossier professionnel sont dans le dossier `docs`.
