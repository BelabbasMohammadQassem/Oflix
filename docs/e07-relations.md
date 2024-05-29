# E07 - relations avec Doctrine

## En cas d'erreur dans une migration

### Si la BDD a déjà été mise en prod

1. Repérer quelle requête est en erreur
2. Pourquoi est-elle en erreur
3. Ajouter des requetes pour corriger
4. Jouer les dernières requetes de la migration
5. Ajouter une entrée dans la table doctrine_migrations_version

### Sinon

A ne pas utiliser si il y a déjà des données en BDD de prod.

```bash
# supprimer les fichiers de migrations
# supprimer la bdd
bin/console doctrine:database:drop --force
# recréer la bdd
bin/console doctrine:database:create
# recréer un fichier de migration
bin/console make:migration
# appliquer les migrations
bin/console doctrine:migration:migrate
```
