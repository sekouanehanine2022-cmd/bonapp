# Déploiement simple

## Préparer le projet

Installer les dépendances avec Composer et vérifier que le fichier `.env` n’est pas versionné.

## Configurer `.env`

Renseigner `APP_URL`, `APP_KEY`, `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` et `DB_PASSWORD`.

## Installer les dépendances

```bash
composer install --no-dev --optimize-autoloader
```

## Configurer la base

Créer une base MySQL vide, puis lancer les migrations et les seeders si nécessaire.

```bash
php artisan migrate --force
php artisan db:seed --force
```

## Stockage des images

Créer le lien public vers le stockage Laravel.

```bash
php artisan storage:link
```

## Caches Laravel

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Vérifications après mise en ligne

- Accueil.
- Liste des recettes.
- Connexion administrateur.
- Administration.
- Ajout, modification et suppression d’une recette.
- Affichage des images.
