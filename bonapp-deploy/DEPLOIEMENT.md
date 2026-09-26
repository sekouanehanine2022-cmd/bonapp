# Déploiement de BonApp avec FileZilla

Ce dossier `bonapp-deploy` est une copie préparée pour le déploiement. Le projet d’origine reste dans `C:\xampp\htdocs\bonapp-laravel`.

## 1. Contenu du dossier à transférer

Avec FileZilla, transférer le contenu du dossier `bonapp-deploy` vers l’hébergement.

Si l’hébergeur permet de choisir le dossier public du site, le domaine doit pointer vers :

```text
public
```

Si l’hébergeur impose un dossier `public_html`, la solution la plus propre est :

- placer les dossiers Laravel (`app`, `bootstrap`, `config`, `database`, `resources`, `routes`, `storage`, `vendor`) hors de `public_html` si l’hébergeur le permet ;
- placer le contenu du dossier `public` dans `public_html` ;
- adapter les chemins de `public_html/index.php` vers le dossier Laravel.

Si l’hébergeur ne permet pas cette séparation, il faut demander à l’hébergeur comment pointer le domaine vers le dossier `public`. Éviter d’exposer directement tout le projet Laravel dans le dossier web public.

## 2. Fichiers et dossiers importants

À transférer :

- `app`
- `bootstrap`
- `config`
- `database`
- `public`
- `resources`
- `routes`
- `storage`
- `vendor`
- `artisan`
- `composer.json`
- `composer.lock`
- `.env.production.example`

À ne pas transférer comme configuration réelle :

- `.env` local
- bases SQLite locales
- caches de développement
- journaux locaux
- dossier `sauvegardes`
- dossier `node_modules`

## 3. Créer le fichier `.env` sur le serveur

Sur le serveur, copier le fichier :

```text
.env.production.example
```

et le renommer :

```text
.env
```

Renseigner les valeurs fournies par l’hébergeur :

```env
APP_URL=https://votre-domaine.fr
DB_HOST=...
DB_DATABASE=...
DB_USERNAME=...
DB_PASSWORD=...
```

Ne jamais mettre le fichier `.env` local ou un vrai mot de passe dans un dépôt Git public.

## 4. Clé Laravel

Laravel a besoin de `APP_KEY`.

Si l’hébergement permet d’utiliser un terminal SSH :

```bash
php artisan key:generate
```

Si l’hébergement ne permet pas SSH, générer une clé sur le poste local dans une copie du projet, puis copier uniquement la valeur `APP_KEY` dans le `.env` du serveur.

## 5. Exporter la base MySQL avec phpMyAdmin

Dans phpMyAdmin local :

1. ouvrir `http://localhost/phpmyadmin` ;
2. sélectionner la base `bonapp_laravel` ;
3. cliquer sur l’onglet `Exporter` ;
4. choisir la méthode `Rapide` ;
5. choisir le format `SQL` ;
6. cliquer sur `Exporter` ;
7. conserver le fichier `.sql` obtenu.

Sur phpMyAdmin de l’hébergement :

1. ouvrir phpMyAdmin depuis le panneau de l’hébergeur ;
2. sélectionner la base MySQL créée pour BonApp ;
3. cliquer sur `Importer` ;
4. choisir le fichier `.sql` exporté ;
5. lancer l’import.

## 6. Images et stockage

Les images fixes du projet sont dans :

```text
public/image
```

Les images envoyées depuis l’administration utilisent le stockage Laravel :

```text
storage/app/public
```

En local, `php artisan storage:link` crée un lien vers `public/storage`. Sur certains hébergements mutualisés, les liens symboliques peuvent être bloqués. Dans ce cas, vérifier la documentation de l’hébergeur ou copier les fichiers de `storage/app/public` vers `public/storage`.

## 7. Permissions

Les dossiers suivants doivent être accessibles en écriture par Laravel :

- `storage`
- `bootstrap/cache`

Selon l’hébergeur, il peut être nécessaire d’ajuster les permissions depuis le panneau d’administration.

## 8. Vérifications après transfert

Tester dans le navigateur :

- page d’accueil ;
- liste des recettes ;
- détail d’une recette ;
- page de connexion ;
- connexion administrateur ;
- administration des recettes ;
- ajout, modification et suppression d’une recette ;
- affichage des images.

## 9. Identifiants de démonstration

Administrateur :

```text
admin@bonapp.local
bonapp123
```

Utilisateur :

```text
user@bonapp.local
bonapp123
```

Ces identifiants servent uniquement à la démonstration. Ils doivent être changés avant une vraie mise en production.
