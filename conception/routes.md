# routes

| URL | VERB | Controller | action | comments |
|---|---|---|---|---|
| `/` | `GET` | `TripController` | `browse` | list all trips |
| `/trip/{id}` | `GET` | `TripController` | `read` | Show one trip |
| `/trip/{id}/comment` | `GET`, `POST` | `TripController` | `addComment` | display and process add comment form |
