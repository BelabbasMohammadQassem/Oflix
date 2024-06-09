# Challenge service

## Service Slugger

Le but est de créer un Service pour slugifier des chaines de caractères

Voila une liste d'exemple

| valeur en entrée | valeur attendue en sortie |
|------------------|---------------------------|
| "" | "" |
| "ABC" | "abc" |
| "  ABC " | "abc" |
| "  A B C " | "a-b-c" |
| "pizzA Hawaienne" | "pizza-hawaienne" |
| "pizza\Hawaienne" | "pizza-hawaienne" |
| "pizza/Hawaienne" | "pizza-hawaienne" |
| "pizza!Hawaienne" | "pizza-hawaienne" |
| "pizza*Hawaienne" | "pizza-hawaienne" |
| "pizza}Hawaienne" | "pizza-hawaienne" |
| "pizza{Hawaienne" | "pizza-hawaienne" |
| "pizza#Hawaienne" | "pizza-hawaienne" |
| "pizza  Hawaienne" | "pizza-hawaienne" |

## Pré Bonus

Pré Bonus : créer un jeu de test unitaire qui va tester notre future classe
cf [md de l'épisode 04](./e04.md)

## Etape 1

Créer un service qui répond à tous les cas fournis

## Etape 2

Modifier l'entité Show pour ajouter une propriété slug

## Etape 3

Utiliser le service pour slugifier le nom du movie lors de la création / mise à jour dans le back office

## Bonus

configurer le service pour que l'on puisse choisir le séparateur à utiliser

## Bonus 2

rechercher comment faire pour utiliser le TimeConverter dans twig directement