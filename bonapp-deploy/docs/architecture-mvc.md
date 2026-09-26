# Architecture MVC

## Modèles

Les modèles représentent les données de l’application. BonApp utilise `User`, `Categorie` et `Recette`.

## Vues Blade

Les vues Blade affichent les pages HTML : accueil, recettes, détail, connexion et administration.

## Contrôleurs

Les contrôleurs reçoivent les requêtes, récupèrent ou modifient les données avec Eloquent, puis renvoient une vue ou une redirection.

## Routes

Les routes relient une URL à une action de contrôleur. Les routes publiques affichent les recettes. Les routes d’administration sont protégées par `auth` et `admin`.

## Fonctionnement général

Le navigateur appelle une route. Laravel exécute le contrôleur associé. Le contrôleur utilise les modèles pour travailler avec la base de données. Une vue Blade affiche ensuite le résultat.
