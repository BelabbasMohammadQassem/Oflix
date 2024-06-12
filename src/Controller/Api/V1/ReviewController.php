<?php

namespace App\Controller\Api\V1;

use App\Entity\Review;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/v1/review', name: 'app_api_v1_review_')]
class ReviewController extends AbstractController
{
    #[Route('/', name: 'add', methods: "POST")]
    public function add(
        EntityManagerInterface $em, 
        Request $request, 
        SerializerInterface $serializer, 
        ValidatorInterface $validator
    ): Response
    {
        // 1. récupérer les données
        $reviewToAdd = new Review();

        // on récupère le json brut de la requete
        $json = $request->getContent();

        // on peut récupérer et créer notre objet "à la main"

        $serializer->deserialize($json, Review::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $reviewToAdd]);
        // 2. validation des données
    
        $errors = $validator->validate($reviewToAdd);
        // si des erreurs ont été détectées
        if (count($errors) > 0)
        {
            // on les renvoit au client
            $info = [
                'success' => false,
                'error_message' => 'Erreur de validation',
                'error_code' => 'review_validation_error',
                'errors' => $errors
            ];
            return $this->json($info, Response::HTTP_BAD_REQUEST);
        }
        dump($reviewToAdd);
        // 3. traitement des données
        $em->persist($reviewToAdd);
        $em->flush();

        // 4. renvoyer une réponse
        return $this->json($reviewToAdd, Response::HTTP_OK, [], ["groups" => "review_browse"]);

    }
}
