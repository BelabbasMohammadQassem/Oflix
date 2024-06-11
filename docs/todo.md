# liste des choses à faire

## TODOs

- dynamiser la page favorites
  - ajouter le lien dans le menu
  - gérer l'ajout en session des favoris
- allumer le bon menu dans la barre de navigation
- diminuer le nombre de requete sur la page `Show::read`
- dynamiser la liste des genres sur la page d'accueil / liste des films
- faire une page de liste de films pour un genre
- faire la page de recherche
- mettre en place une pagination sur la page de liste des films
- dans les routes, mettre l'url `/film/slug` pour un film ou `/serie/slug` pour une serie
- Terminer le Timechercher comment faire pour utiliser le TimeConverter dans twig directeeConverter ( gérer l'affichage des semaines, gérer les demi minutes)
- Trouver le moyen de classer automatiquement les acteurs par ordre de creditOrder.
- Calculer le rating en fonction des Review ( on peut si on le souhaite supprimer le champ en BDD, mais le garder dans l'entité)
- Gérer les relations lors de la suppression d'un show
- afficher les flashmessages sur toutes les pages du back
- gérer les roles dans une entité séparées
  - attention à corriger les migrations pour ne pas perdre les roles attribués actuellement
  - il faudra aussi corriger les fixtures
- afficher la liste des étoiles en fonction de la note
- coté front, permettre d'accéder à un movie grace à son slug

## Done

- gérer les 404
- ajouter le nom du film dans le titre de la page show/read.html.twig