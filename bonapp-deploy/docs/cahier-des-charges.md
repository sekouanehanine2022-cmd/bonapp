# Cahier des charges BonApp

## Contexte

BonApp est un projet Laravel réalisé comme support de dossier professionnel pour le titre Concepteur Développeur d’Applications.

## Objectif

L’application permet de consulter des recettes publiées et de les gérer depuis une administration simple réservée aux administrateurs.

## Utilisateurs

- Visiteur : consulte les recettes publiées.
- Utilisateur connecté : consulte les recettes publiées.
- Administrateur : gère les recettes et les catégories.

## Fonctionnalités principales

- Page d’accueil.
- Liste des recettes publiées.
- Recherche par titre.
- Filtre par catégorie.
- Détail d’une recette.
- Connexion et déconnexion.
- CRUD des recettes pour l’administrateur.
- CRUD des catégories pour l’administrateur.

## Contraintes techniques

- Laravel 12.
- PHP 8.2.
- Blade.
- Bootstrap.
- MySQL avec XAMPP/phpMyAdmin en local.
- SQLite uniquement pour les tests automatisés.

## Règles de sécurité

- Validation côté serveur.
- Protection CSRF.
- Mots de passe hachés.
- Routes d’administration protégées.
- Rôle `admin` obligatoire pour gérer les données.
- Fichier `.env` exclu du dépôt.
