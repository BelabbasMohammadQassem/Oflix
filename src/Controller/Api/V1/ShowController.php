<?php

namespace App\Controller\Api\V1;

use App\Repository\ShowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class ShowController extends AbstractController
{
    #[Route('/api/v1/show', name: 'app_api_v1_show')]
    public function index(ShowRepository $showRepository): JsonResponse
    {
        // préparer les données
        $allShows = $showRepository->findAll();

        // exemple un groupe de sérialisation par endpoint => show_index 
        // exemple deux groupes par entités 
        //  show_base, show_join
        //  type_base, type_join
        // renvoyer les données au format json
        return $this->json($allShows, 200, [], ['groups' => 'show_index']);
        // return $this->json($allShows, 200, [], ['groups' => ['show_base', 'type_join', 'casting_join']]);
    }
}
