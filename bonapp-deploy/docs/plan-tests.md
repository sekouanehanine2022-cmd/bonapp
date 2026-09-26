# Plan de tests

| N° | Objectif | Étapes | Résultat attendu | Résultat obtenu | Statut |
|---:|---|---|---|---|---|
| 1 | Page recettes accessible | Ouvrir `/recettes` | Statut 200 | Vérifié par test automatisé | OK |
| 2 | Détail recette accessible | Ouvrir une recette publiée | Statut 200 | Vérifié par test automatisé | OK |
| 3 | Visiteur bloqué | Ouvrir `/administration` sans connexion | Redirection connexion | Vérifié par test automatisé | OK |
| 4 | Utilisateur normal bloqué | Se connecter en `user` puis ouvrir l’administration | Statut 403 | Vérifié par test automatisé | OK |
| 5 | Administrateur autorisé | Se connecter en `admin` | Administration accessible | Vérifié par test automatisé | OK |
| 6 | Ajouter recette | Envoyer le formulaire de création | Recette créée | Vérifié par test automatisé | OK |
| 7 | Modifier recette | Envoyer le formulaire de modification | Recette modifiée | Vérifié par test automatisé | OK |
| 8 | Supprimer recette | Confirmer une suppression | Recette supprimée | Vérifié par test automatisé | OK |
| 9 | Validation formulaire | Envoyer un formulaire vide | Erreurs affichées | Vérifié par test automatisé | OK |
| 10 | Catégorie utilisée protégée | Supprimer une catégorie liée à une recette | Suppression refusée | Vérifié par test automatisé | OK |
