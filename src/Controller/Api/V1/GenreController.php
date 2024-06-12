<?php

namespace App\Controller\Api\V1;

use App\Entity\Genre;
use App\Repository\GenreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/v1/genre', name: 'app_api_v1_genre_')]
class GenreController extends AbstractController
{
    #[Route('/', name: 'browse', methods: "GET")]
    public function browse(GenreRepository $genreRepository): JsonResponse
    {
        $allGenres = $genreRepository->findAll();
        
        return $this->json($allGenres, 200, [], ["groups" => "genre_browse"]);
    }

    #[Route('/{id}', name: 'edit', methods: ["PATCH", "PUT"], requirements: ["id" => "\d+"])]
    public function edit(
        $id, 
        EntityManagerInterface $em, 
        GenreRepository $genreRepository, 
        Request $request, 
        SerializerInterface $serializer,
        ValidatorInterface $validator
    ): JsonResponse
    {
        // 1. récupérer les données
        $genreToUpdate = $genreRepository->find($id);

        // gestion des 404
        if (is_null($genreToUpdate))
        {
            $info = [
                'success' => false,
                'error_message' => 'Genre non trouvé',
                'error_code' => 'genre_not_found',
            ];
            return $this->json($info, Response::HTTP_NOT_FOUND);
        }

        // on récupère le json brut de la requete
        $json = $request->getContent();

        $serializer->deserialize($json, Genre::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $genreToUpdate]);
        // 2. validation des données
    
        $errors = $validator->validate($genreToUpdate);
        // si des erreurs ont été détectées
        if (count($errors) > 0)
        {
            // on les renvoit au client
            $info = [
                'success' => false,
                'error_message' => 'Erreur de validation',
                'error_code' => 'genre_validation_error',
                'errors' => $errors
            ];
            return $this->json($info, Response::HTTP_BAD_REQUEST);
        }
        // 3. traitement des données
        $em->flush();

        // 4. renvoyer une réponse
        return $this->json($genreToUpdate, Response::HTTP_OK, [], ["groups" => "genre_browse"]);
    }

    #[Route('/', name: 'add', methods: "POST")]
    public function add(EntityManagerInterface $em, Request $request, ValidatorInterface $validator): JsonResponse
    {
        if (! $this->isGranted('ROLE_ADMIN'))
        {
            $info = [
                'success' => false,
                'error_message' => 'Non autorise',
                'error_code' => 'not_authorized',
            ];
            return $this->json($info, Response::HTTP_FORBIDDEN);
        }
        // 1. récupérer les données
        // https://symfony.com/doc/current/components/http_foundation.html#accessing-request-data
        $data = $request->getPayload();
        $name = $data->get('name');

        // 2. valider les données
        // pour valider les données avec le validator, 
        // on créer une entité 
        $genre = new Genre();
        $genre->setName($name);

        // et le validator vérifiera les contraintes définies dessus
        $errors = $validator->validate($genre);
        // si des erreurs ont été détectées
        if (count($errors) > 0)
        {
            // on les renvoit au client
            $info = [
                'success' => false,
                'error_message' => 'Erreur de validation',
                'error_code' => 'genre_validation_error',
                'errors' => $errors
            ];
            return $this->json($info, Response::HTTP_BAD_REQUEST);
        }

        // ici on est sur que les données sont valides

        // 3. faire le traitement des données
        // ici insérer le genre en BDD
        $em->persist($genre);
        $em->flush();

        // 4. renvoyer une réponse en JSON

        return $this->json($genre, Response::HTTP_CREATED, [], ["groups" => "genre_browse"]);
    }

    #[Route('/{id}/show', name: 'show', requirements: ["id" => "\d+"], methods: "GET")]
    public function showList($id, GenreRepository $genreRepo): JsonResponse
    {
        /*
         * en mode API, on ne peut pas laisser le ParamConverter renvoyé une 404 
         * si la ressource n'est pas trouvée 
         * Dans ce cas on fait la récupération et la gestion d'erreur "à la main"
         * Ainsi l'utilisateur du endpoint aura le message d'erreur au format json
         */
        $genre = $genreRepo->find($id);
        if (is_null($genre))
        {
            $info = [
                'success' => false,
                'error_message' => 'Genre non trouvé',
                'error_code' => 'genre_not_found',
            ];
            return $this->json($info, Response::HTTP_NOT_FOUND);
        }

        // $info = [
        //     'success' => true,
        //     'content' => $genre->getShows()
        // ];
        return $this->json($genre->getShows(), 200, [], ["groups" => "show_browse"]);
    }

    #[Route('/show/delete/{id}/', name: 'show', requirements: ["id" => "\d+"], methods: "DELETE")]
    public function showDelete($id, GenreRepository $genreRepo,  EntityManagerInterface $em): JsonResponse
    {
        // Preparer la donnée
        $genreDelete = $genreRepo->find($id);

        // envoi d'une erreur si erreur
        if (is_null($genreDelete))
        {
            $info = [
                'success' => false,
                'error_message' => 'genre non trouvé',
                'error_code' => 'genre_not_found',
            ];

            // renvoyer la donnée sous format json
            return $this->json($info, Response::HTTP_NOT_FOUND);
        }

           // 3. faire le traitement des données
        // ici insérer le genre en BDD
        $em->remove($genreDelete);
        $em->flush();

        return $this->json([
            'success' => true,
            'message' => 'genre supprimé avec succès'
        ], Response::HTTP_OK);
    
        
    }
}
