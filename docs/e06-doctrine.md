# E06

## Installation

```bash
composer require orm #( attention si vous avez docker )
```

configurer la BDD
    - créer un fichier `.env.local`
    - copier la ligne du fichier `.env` qui contient Mariadb
    - avec : `DATABASE_URL="mysql://USER_BDD:MDP_USER_BDD@127.0.0.1:3306/NOM_BDD?serverVersion=VERSION_MARIADB&charset=utf8mb4"`
        - USER_BDD = nom user bdd
        - MDP_USER_BDD = mdp
        - NOM_BDD = oflix
        - VERSION_MARIADB : mettre le résutalt de `mysql --version` la partie qui ressemble à `10.3.39-MariaDB`

## Création de la BDD

Avec Doctrine, on crée la bdd et les tables à partir du terminal

```bash
bin/console doctrine:database:create
```

## Création des tables

- créer l'entité `bin/console make:entity`
  - ajouter les annotations
- créer une migration avec : `bin/console make:migration`
- relire la migration
- appliquer la migration en BDD : `bin/console doctrine:migrations:migrate`

## HELP

Impossible d'accéder à MariaDB depuis le conteneur

```bash
# desactivation de apache en local
sudo systemctl stop apache2
# modifier le compose.yaml pour lancer le conteneur directement depuis l'hote
# + network_mode: "host"
# - ports
# on peut accéder à http://localhost 
# /!\ à refaire au redémarrage de la machine
```

## Kill Docker RIP

```bash
# arreter les containers
docker compose down
# redémarrer apache
sudo systemctl restart apache2
# modifier composer.json
# remplacer 6.4.* par 7.*
sudo chown -R student:www-data .
composer update
```
