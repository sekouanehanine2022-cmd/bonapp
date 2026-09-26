# Schéma de base de données

BonApp conserve trois tables métier.

## users

- Clé primaire : `id`.
- Champs principaux : `name`, `email`, `password`, `role`, `remember_token`, timestamps.
- Le champ `role` vaut `admin` ou `user`.
- Relation : un utilisateur possède plusieurs recettes.

## categories

- Clé primaire : `id`.
- Champs principaux : `nom`, `description`, timestamps.
- Relation : une catégorie possède plusieurs recettes.

## recettes

- Clé primaire : `id`.
- Clés étrangères : `user_id` vers `users`, `categorie_id` vers `categories`.
- Champs principaux : `titre`, `description`, `ingredients`, `instructions`, `image`, `temps_preparation`, `nombre_personnes`, `difficulte`, `statut`.
- Relation : une recette appartient à un utilisateur et à une catégorie.
