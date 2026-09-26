# BonApp Laravel

Version Laravel du projet BonApp.

## Lancement local

1. Demarrer MySQL dans XAMPP.
2. Ouvrir un terminal dans ce dossier :
   `C:\xampp\htdocs\site de cuisine\bonapp-laravel`
3. Creer la base si besoin :
   `C:\xampp\mysql\bin\mysql.exe -u root -e "CREATE DATABASE IF NOT EXISTS bonapp_laravel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"`
4. Installer ou verifier les dependances :
   `composer install`
5. Lancer les migrations avec les donnees de demo :
   `php artisan migrate:fresh --seed`
6. Lancer le serveur :
   `php artisan serve --host=127.0.0.1 --port=8000`

## Liens

- Accueil : `http://127.0.0.1:8000`
- Recettes : `http://127.0.0.1:8000/recettes`
- Ajouter une recette : `http://127.0.0.1:8000/recettes/ajouter`
- API recettes : `http://127.0.0.1:8000/api/recettes`
- Diagramme de classe : `http://127.0.0.1:8000/diagramme-classe`

## Structure ajoutee

- `app/Models` : modeles Eloquent du domaine BonApp.
- `app/Http/Controllers/RecetteController.php` : controleur des recettes.
- `database/migrations/2026_09_15_000000_create_bonapp_domain_tables.php` : schema complet.
- `database/seeders/DatabaseSeeder.php` : donnees de demo.
- `resources/views` : vues Blade.
- `public/css`, `public/js`, `public/image`, `public/docs` : assets repris du site original.
