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
| `/back/show/{id}/delete` | `GET`        | `ShowController` | `delete`  | - | Supprime le show et les commentaires associés ( et les casting ? ) |
| `/show/{id}/casting/` | `GET`        | `CastingController` | `browse`  | Administration des castings d'un show | Liste des castings |
| `/show/{id}/casting/{id}` | `GET`        | `CastingController` | `read`  | Visualisation d'un casting + bouton d'action sur les relations ( gérer les commentaires ) | Détail d'un casting |
| `/show/{id}/casting/{id}/edit` | `GET`, `POST`        | `CastingController` | `edit`  | Editer un casting | Affiche / traite le formulaire d'édition |
| `/show/{id}/casting/add` | `GET`, `POST`        | `CastingController` | `add`  | Ajouter un casting | Affiche / traite le formulaire d'ajout |
| `/show/{id}/casting/{id}/delete` | `GET`        | `CastingController` | `delete`  | - | Supprime le casting et les commentaires associés ( et les casting ? ) |
| `/back/country/` | `GET`        | `CountryController` | `browse`  | Administration des countries | Liste des countries |
| `/back/country/{id}` | `GET`        | `CountryController` | `read`  | Visualisation d'un country  | Détail d'une country |
| `/back/country/{id}/edit` | `GET`, `POST`        | `CountryController` | `edit`  | Editer une country | Affiche / traite le formulaire d'édition |
| `/back/country/add` | `GET`, `POST`        | `CountryController` | `add`  | Ajouter une country | Affiche / traite le formulaire d'ajout |
| `/back/country/{id}/delete` | `GET`        | `CountryController` | `delete`  | - | Supprime la country |

## API V1

Les controllers de l'API sont dans un sous dossier api

Les URL de l'API vont etre versionné api/V1

| endpoint | Méthode HTTP | Contrôleur       | Méthode | Commentaire    |
| --- | ------------ | ---------------- | ------- | -------------- |
| `/api/V1/show/`       | `GET`        | `ShowController` | `browse`    | Liste des shows |
| `/api/V1/show/`       | `POST`       | `ShowController` | `add`       | Ajoute |
| `/api/V1/show/{id}`   | `GET`        | `ShowController` | `read`      | Détail d'un show |
| `/api/V1/show/random` | `GET`        | `ShowController` | `random`    | Renvoit un film au hasard |
| `/api/V1/show/{id}`   | `PUT`,`PATCH`| `ShowController` | `edit`      | Modification d'un show |
| `/api/V1/show/{id}`   | `DELETE`     | `ShowController` | `delete`    | Supprime le show et les commentaires |
| `/api/V1/genre/`       | `GET`        | `GenreController` | `browse`    | Liste des genres |
| `/api/V1/genre/`       | `POST`       | `GenreController` | `add`       | Ajoute |
| `/api/V1/genre/{id}`   | `GET`        | `GenreController` | `read`      | Détail d'un genre |
| `/api/V1/genre/{id}`   | `PUT`,`PATCH`| `GenreController` | `edit`      | Modification d'un genre |
| `/api/V1/genre/{id}`   | `DELETE`     | `GenreController` | `delete`    | Supprime le genre |
| `/api/V1/genre/{id}/show` | `GET`     | `GenreController` | `showList`  | Liste les show par genre |
| `/api/V1/review/`      | `POST`       | `ReviewController` | `add`       | Ajoute une review |
