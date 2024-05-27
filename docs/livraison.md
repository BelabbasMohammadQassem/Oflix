# Procédure de livraison

## Rappels de git

- branche master => le code qui est livré en prod
- branche dev => le code qui contient tous les développements
- branche par fonctionnalité

## étapes de livraison

- merger les branches de fonctionnalités dans dev
- tester que dev fonctionne bien
- merger sur master
- push sur github
- se connecter sur le serveur
- aller dans le dossier du projet
- `git pull`
- lancer `composer install`

## problème rencontré

- le vhost oflix n'est pas configuré sur le bon dossier => modifier le fichier /etc/apache2/sites-available/oflix.conf
- attention pour tester le site à bien y accéder en http et pas en https