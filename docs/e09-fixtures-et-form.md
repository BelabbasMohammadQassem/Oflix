# E09 - fixtures et form

## Fixtures

La création de fausses données

- ne fait pas partie de l'application ( on n'en veux pas en prod donc pas dans un controller )
- est utile en dev ( pour avoir des données rapidement dans l'application )

On peut utiliser le composant fixtures.

Installation : `composer require --dev doctrine/doctrine-fixtures-bundle`

Ce dernier nous permet d'exécute une commande pour générer des fausses données.

On a donc déplacer le code de SandboxController::populateDatabase dans le fichier AppFixtures ( créé lors de l'installation )

Pour exécuter le code on lance : `bin/console doctrine:fixtures:load`

### Faker

Il existe un composant qui permet de générer des données aléatoires ( des valeurs uniquement, on doit quand meme créer les objets )

Ce composant c'est [PHPFaker](https://fakerphp.org/)

## Form

- [la doc officielle](https://symfony.com/doc/current/forms.html)
- [la liste des form types](https://symfony.com/doc/current/reference/forms/types.html)
- [la liste des contraintes de validation](https://symfony.com/doc/current/reference/constraints.html)

### Installation

```bash
# composant formulaire
composer require symfony/form
# composant de validation
composer require symfony/validator
```

### Création d'une classe formulaire

La classe de formualaire permet de définir le contenu d'un formulaire. On peut le créer avec la commande `bin/console make:form`

### Affichage d'un formulaire

L'affichage se passe en deux étapes.

1. Dans le Controller, création d'un objet de la classe de formulaire ( cf oblog `PostController::read` pour le formulaire de Comment )
2. Dans le template, gérer l'affichage du formulaire ( avec les fonctions twig `form_start`, `form_row` et `form_end`)

### Traitement du formulaire

Dans les bonnes de pratique de Symfony, il est conseillé de faire le traitement dans la même action que celle qui affiche le formulaire.

le code final ressemblera toujours à

```php
// route accessible en GET et en POST
public function monAction(Request $request, EntityManagerInterface $em)
{
    $entite = new Entite();
    $form = $this->createForm(MonEntiteType::class, $entite)
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
        // 3 traiter le formulaire
        $em->persist($entite);

        $em->flush();
        return $this->redirectToRoute('app_post_read', ['id' => $post->getId()]);
    }

    return $this->render('mon/template.html.twig', [
        'form' => $form,
    ]);
}
```

### Validation des données

La méthode $form->isValid() nous permet d'ajouter des validations des données avant l'enregistrement en BDD.
Cette méthode utilise le composant validator ( installé au début ).

Ce composant va se baser sur des attributs ajoutés sur nos entités ( cf oblog `App\Entity\Comment` )

## Astuces

- affichage en mode bootstrap 5 : modifier la configuration de twig [cf cette section](https://symfony.com/doc/current/forms.html#rendering-forms)
- désactiver la validation du navigateur : rajouter au niveau du form_start l'option suivante : `{"attr" : {"novalidate" : "novalidate"}}`