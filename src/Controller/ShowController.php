<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShowController extends AbstractController
{
    #[Route('/show', name: 'app_show_browse', methods: ['GET'])]
    #[Route('/recherche', name: 'app_show_search', methods: ['GET'])]
    public function browse(): Response
    {
        // 1. préparation des données
        // différencier si on est une page de recherche

        // 2. affichage de la vue
        return $this->render('show/browse.html.twig');
    }

    #[Route('/show/{id}', name: 'app_show_read', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function read(int $id): Response
    {
        // 1. préparation des données
        require __DIR__ . '/../../sources/data.php';
        // todo faire la page 404
        $show = $shows[$id];


        // 2. affichage de la vue
        return $this->render('show/read.html.twig', [
            'show' => $show
        ]);
    }
}