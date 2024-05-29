<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FavoriteController extends AbstractController
{
    #[Route('/favoris', name: 'app_favorite_browse')]
    public function browse(): Response
    {
        return $this->render('favorite/browse.html.twig', [
            'controller_name' => 'FavoriteController',
        ]);
    }
}
