<?php

namespace App\Controller\Api\V1;

use App\Repository\ShowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1/show', name: 'app_api_v1_show_')]
class ShowController extends AbstractController
{
    #[Route('/', name: 'browse')]
    public function browse(ShowRepository $showRepository): JsonResponse
    {
        // préparer les données
        $allShows = $showRepository->findAll();

        // exemple un groupe de sérialisation par endpoint => show_browse 
        // exemple deux groupes par entités 
        //  show_base, show_join
        //  type_base, type_join
        // renvoyer les données au format json
        return $this->json($allShows, 200, [], ['groups' => 'show_browse']);
        // return $this->json($allShows, 200, [], ['groups' => ['show_base', 'type_join', 'casting_join']]);
    }

    #[Route('/random', name: 'random')]
    public function random(ShowRepository $showRepository): JsonResponse
    {
        // attention pour récupérer un élément au hasard 
        // plus il y aura de lignes, plus cette facon de faire sera mauvaise
        // cf le code de Julien dans le récap e16
        $allShows = $showRepository->findAll();
        shuffle($allShows);

        $randomShow = $allShows[0];

        return $this->json($randomShow, 200, [], ['groups' => 'show_browse']);
    }
}
