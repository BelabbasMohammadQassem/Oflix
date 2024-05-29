# Routes de l'application

| URL | Méthode HTTP | Contrôleur       | Méthode | Titre HTML           | Commentaire    |
| --- | ------------ | ---------------- | ------- | -------------------- | -------------- |
| `/` | `GET`        | `MainController` | `home`  | Bienvenue sur O'flix | Page d'accueil |
| `/show` | `GET`        | `ShowController` | `browse`  | Liste des films / séries | - |
| `/recherche` | `GET`        | `ShowController` | `browse`  | Résultat de la recherche | - |
| `/show/{id}` | `GET`        | `ShowController` | `read`  | Détail du film {nom_du_film} | Détail d'un show |
| `/favoris` | `GET`        | `FavoriteController` | `browse`  | Mes favoris | Les favoris de l'utilisateur |
| `/favoris/{id}` | `GET`     | `FavoriteController` | `add`  | - | ajoute aux favoris et redirige l'utilisateur |
