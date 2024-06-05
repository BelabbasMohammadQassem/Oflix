# Routes de l'application

| URL | Méthode HTTP | Contrôleur       | Méthode | Titre HTML           | Commentaire    |
| --- | ------------ | ---------------- | ------- | -------------------- | -------------- |
| `/` | `GET`        | `MainController` | `home`  | Bienvenue sur O'flix | Page d'accueil |
| `/show` | `GET`        | `ShowController` | `browse`  | Liste des films / séries | - |
| `/recherche` | `GET`        | `ShowController` | `browse`  | Résultat de la recherche | - |
| `/show/{id}` | `GET`        | `ShowController` | `read`  | Détail du film {nom_du_film} | Détail d'un show |
| `/favoris` | `GET`        | `FavoriteController` | `browse`  | Mes favoris | Les favoris de l'utilisateur |
| `/favoris/{id}` | `GET`     | `FavoriteController` | `add`  | - | ajoute aux favoris et redirige l'utilisateur |
| `/show/{id}/commenter` | `GET`     | `ShowController` | `reviewAdd`  | - | affiche le formulaire d'ajout de commentaire |
| `/show/{id}/commenter` | `POST`     | `ShowController` | `reviewAdd`  | - | traite le formulaire d'ajout de commentaire |

## Back Office

Les controllers du back office sont dans un sous dossier back office

| URL | Méthode HTTP | Contrôleur       | Méthode | Titre HTML           | Commentaire    |
| --- | ------------ | ---------------- | ------- | -------------------- | -------------- |
| `/back/` | `GET`        | `MainController` | `home`  | Bienvenue sur le backoffice | Page d'accueil |
| `/back/show/` | `GET`        | `ShowController` | `browse`  | Administration des shows | Liste des shows |
| `/back/show/{id}` | `GET`        | `ShowController` | `read`  | Visualisation d'un show + bouton d'action sur les relations ( gérer les commentaires ) | Détail d'un show |
| `/back/show/{id}/edit` | `GET`, `POST`        | `ShowController` | `edit`  | Editer un show | Affiche / traite le formulaire d'édition |
| `/back/show/add` | `GET`, `POST`        | `ShowController` | `add`  | Ajouter un show | Affiche / traite le formulaire d'ajout |
| `/back/show/{id}` | `GET`        | `ShowController` | `delete`  | - | Supprime le show et les commentaires associés ( et les casting ? ) |
