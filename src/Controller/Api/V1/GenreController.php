<?php

namespace App\Controller\Api\V1;

use App\Repository\GenreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class GenreController extends AbstractController
{
    #[Route('/api/v1/genre', name: 'app_api_v1_genre')]
    public function index(GenreRepository $genreRepository): JsonResponse
    {
         // préparer les données
         $allGenre = $genreRepository->findAll();

         return $this->json($allGenre, 200, [], ['groups' => 'genre_index']);
            // 'message' => 'Welcome to your new controller!',
            // 'path' => 'src/Controller/Api/V1/genreController.php',
       
    }

    #[Route('/api/v1/genre/{id}', name: 'app_api_v1_genre')]
    public function genre(GenreRepository $genreRepository): JsonResponse
    {
         // préparer les données
         $allGenre = $genreRepository->findAll();

         return $this->json($allGenre, 200, [], ['groups' => 'genre_index', 'genre_base']);
            // 'message' => 'Welcome to your new controller!',
            // 'path' => 'src/Controller/Api/V1/genreController.php',
       
    }
}
