<?php

namespace App\Controller;

use App\Entity\Show;
use App\Repository\ShowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShowController extends AbstractController
{
    #[Route('/show', name: 'app_show_browse', methods: ['GET'])]
    #[Route('/recherche', name: 'app_show_search', methods: ['GET'])]
    public function browse(ShowRepository $showR): Response
    {
        // 1. préparation des données
        $allShows = $showR->findAllWithAssociation(); 
        // différencier si on est une page de recherche

        // 2. affichage de la vue
        return $this->render('show/browse.html.twig', [
            'showList' => $allShows
        ]);
    }

    #[Route('/show/{id}', name: 'app_show_read', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function read(Show $show): Response
    {
        // 1. préparation des données


        // 2. affichage de la vue
        return $this->render('show/read.html.twig', [
            'show' => $show
        ]);
    }
}
