# Logique de la base BonApp

La base est organisée autour de trois grands blocs :

1. Les utilisateurs
   - `roles` définit les profils : admin, client, chef.
   - `utilisateurs` contient les comptes.
   - `profils_clients` complète un utilisateur client avec ses préférences.
   - `adresses` permet à un client d'avoir une ou plusieurs adresses.

2. Le catalogue culinaire
   - `recettes` est l'entité centrale.
   - `categories` classe les recettes : plat, dessert, soupe, healthy, facile, etc.
   - `recette_categories` gère la relation plusieurs-à-plusieurs entre recettes et catégories.
   - `ingredients_catalogue` liste les ingrédients réutilisables.
   - `recette_ingredients` détaille les quantités d'ingrédients pour chaque recette.
   - `unites` évite de répéter les unités comme g, ml, pièce.
   - `etapes_recette` permet de séparer les instructions étape par étape.
   - `medias_recette` permet d'attacher plusieurs images ou vidéos à une recette.
   - `allergenes`, `ingredient_allergenes` et `utilisateur_allergenes` servent à comparer les allergies du client avec les ingrédients d'une recette.

3. Les actions client
   - `avis` permet à un client de noter une recette de 1 à 5.
   - `commentaires` permet de discuter sous une recette, avec des réponses via `parent_id`.
   - `favoris` permet de sauvegarder une recette.
   - `collections` et `collection_recettes` permettent de créer des listes personnalisées de recettes.
   - `planifications` représente un menu sur plusieurs dates.
   - `repas_planifies` place une recette dans un jour et un type de repas.
   - `listes_courses` et `liste_courses_items` permettent de construire une liste de courses, éventuellement à partir d'une planification.

## Relations importantes

- Un `Role` possède plusieurs `Utilisateurs`.
- Un `Utilisateur` peut être client, chef ou admin selon son rôle.
- Un `Utilisateur` chef ou admin peut publier plusieurs `Recettes`.
- Une `Recette` peut avoir plusieurs `Categories`, et une `Categorie` peut contenir plusieurs `Recettes`.
- Une `Recette` contient plusieurs `RecetteIngredients`, chaque ligne pointant vers un ingrédient du catalogue.
- Un `Utilisateur` peut ajouter plusieurs recettes en favoris, noter plusieurs recettes et écrire plusieurs commentaires.
- Une `Planification` appartient à un utilisateur et contient plusieurs repas planifiés.
- Une `ListeCourses` appartient à un utilisateur et peut être reliée à une planification.

## Pour ton diagramme de classe

Tu peux utiliser `docs/diagramme_classe_bonapp.mmd` comme base Mermaid.
Les tables de liaison comme `recette_categories`, `favoris` ou `collection_recettes` deviennent des classes d'association.
