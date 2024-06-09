# Sécurité

## Rappels

1. ENREGISTREMENT DE L'UTILISATEUR
   - penser à hasher le mdp
2. AUTHENTIFICATION
   - page de login
   - traiter la page
     - vérifier que le user existe
     - vérifier le mot de passe => avec password_verify
     - connecter l'utilisateur => enregistrer son id en session par exemple
3. AUTHORIZATION
   - vérifier les droits
   - gestion des droits par role
   - ACL ( Access Control List )
     - qui a le droit :notes: Patriiiiickk

## Installation avec Symfony

cf [la doc](https://symfony.com/doc/current/security.html)

```bash
# installation du composant
composer require symfony/security-bundle
# création de l'entité User qui sera utilisée par le composant de sécurité
# cette entité est modifiable par la suite avec le make:entity
php bin/console make:user
# creer la migration et l'appliquer
bin/console make:migration
bin/console doctrine:migration:migrate

# dans adminer créer un utilisateur
# pour avoir un mdp hasher utiliser la commande suivante
bin/console security:hash-password
# pour le champ role il faut un tableau de chaine de caractere formaté en json
# par exemple
# /!\ Tous les roles doivent commencer par ROLE_
# ["ROLE_USER", "ROLE_ADMIN"]


# Création du formulaire de login
bin/console make:security:form-login
```

## Empecher l'accès à des pages

On peut le faire soit dans le fichier `package/security.yaml`
ou alors dans le code

- dans un controlleruser
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'help' => "Laisser vide pour garder l'ancien",
                'mapped' => false
            ])
  - dans l'action `$this->denyAccessUnlessGranted('ROLE_ADMIN');`
  - ou avec un attribut `#[IsGranted('ROLE_ADMIN')]`
- dans un template avec `is_granted('ROLE_ADMIN')`

### Logique du composant de sécurité

A chaque fois que l'on vérifier les autorisations ( avec `isGranted` ou `denyAccessUnlessGranted`), le composant de sécurité applique cette logique :

1. lister tous les voters de l'application
   - RoleVoter
   - ???
2. pour chaque voter
   - veux tu voter ( supportsAttribute() )
   - si oui quel est ton vote ( vote() )
3. faire le choix
   - avec l'ensemble des votes on fait un choix
      - le premier votant a raison
      - le premier qui dit oui a raison
      - le premier qui dit non a raison
      - le plus grand nombre gagne
      - unanimité des votants

### Avec des Voters personnalisés

cf [la doc](https://symfony.com/doc/current/security/voters.html#checking-for-roles-inside-a-voter)

Lorsque les règles d'accès sont plus complexes ( en fonction d'un objet ou d'une date ) alors on peut écrire cette logique dans un Voter personnalisé.

Un Voter est une classe qui implémente la classe `Component\Security\Core\Authorization\Voter\Voter` de Symfony et doit donc avoir deux méthodes :

- méthode `supports` pour dire si elle veux voter ou non
- méthode `voteOnAttribute` pour donner son vote

Cette logique sera appliquée en utilisant les fonctions suivantes

- `denyAccessUnlessGranted`
- `isGranted`
- et `is_granted` dans `twig`

