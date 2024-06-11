# Recettes API pour Symfony

## Une API ?

- On parle bien d'**API web** = interface de communication entre et un client et un serveur.
- Objectif : transmettre/échanger/exposer des données **via des URLs**, qu'on appelle des _endpoints_ dans l'univers API.

## Quelle convention pour notre API ?

- L'API REST est LE standard qui défini des règles concernant la structure des requêtes et des réponses échangées.
- [Ce site rappelle les conventions de l'API REST](https://www.restapitutorial.com/lessons/httpmethods.html).

## Et côté Symfony ?

- On crée les routes de l'API (+ le(s) contrôleur(s)).
- On va chercher les données dans le Repository ou on les manipule avec le Manager.
- On va retourner nos données en JSON (encodage).
  - Format d'échange entrée/sortie requête/réponse quand nécessaire = JSON.
  - En cas de création/modification, on va devoir traiter une donnée JSON qui arrive de la requête.
- Dans tous les cas on va renvoyer le bon status code HTTP (200, 201, 404 etc.).

### Nos routes

> :hand: Convention de nommage : https://restfulapi.net/resource-naming/

| Endpoint                  | Méthode HTTP | Description                                                                                   | Retour                          |
| ------------------------- | ------------ | --------------------------------------------------------------------------------------------- | ------------------------------- |
| `/api/V1/shows`             | `GET`        | Récupération de tous les films                                                                | 200                             |
| `/api/V1/shows/{id}`        | `GET`        | Récupération du film dont l'id est fourni                                                     | 200 ou 404                      |
| `/api/V1/shows`             | `POST`       | Ajout d'un film _+ la donnée JSON qui représente le nouveau film_                             | 201 + Location: /shows/{newID} |
| `/api/V1/shows/{id}`        | `PUT`        | Modification d'un film dont l'id est fourni _+ la donnée JSON qui représente le film modifié_ | 200, 204 ou 404                 |
| `/api/V1/shows/{id}`        | `DELETE`     | Suppression d'un film dont l'id est fourni                                                    | 200 ou 404                      |
| `/api/V1/shows/random`      | `GET`        | Récupération du film au hasard                                                                | 200 ou 404                      |
| `/api/V1/genres`             | `GET`        | Récupération de tous les genres                                                               | 200                             |
| `/api/V1/genres/{id}/shows` | `GET`        | Récupération de tous les films du genre donné                                                | 200 ou 404                      |

### Sérialisation des entités

- Après récupération, on veut encoder nos données en JSON, par ex. via `return $this->json($data);` (= on renvoie une réponse JSON).
- Si on tombe sur l'erreur `A circular reference has been detected when serializing the object` c'est à cause des relations et des objets qui bouclent entre eux => :hand: ne pas essayer _tout de suite_ de régler cette configuration comme indiqué sur le net, voir les solutions ci-dessous.

#### Solution 1

Serializer + Groups. Voir exemple sur `api_shows_read`. On utilise le Serializer de Symfony pour convertir les entités Doctrine (objets PHP) en représentation JSON, en appliquant le groupe `shows_read`. Ces groupes sont définis dans les entités que l'on souhaite afficher, ici Show et Genre. On pourrait ajouter d'autres entités comme Casting et/ou Team sur cet exemple (et dans la réalité, selon les besoins du endpoint de l'API).

#### Autres solutions à tester

- Requêtes custom avec jointures dans le Repository.
- Utiliser la configuration du serializer pour les références circulaires : https://symfony.com/doc/current/components/serializer.html#handling-circular-references

### Exercice/Challenge

- Créer le endpoint pour lister tous les genres.
- Créer le endpoint pour lister tous les films d'un genre donné.
- Créer un endpoint pour aller chercher un film au hasard.

### Bonus

- Créer les endpoint restant du tableau de routes
