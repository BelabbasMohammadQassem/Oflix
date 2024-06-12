<?php

namespace App\Controller\Api\V1;

use App\Entity\Show;
use App\Repository\ShowRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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

    #[Route('/show/put/{id}/', name: 'show', requirements: ["id" => "\d+"], methods: ["PATCH", "PUT"] )]
    public function showPut($id, ShowRepository $showRepo,  EntityManagerInterface $em,   SerializerInterface $serializer,
    ValidatorInterface $validator, Request $request,): JsonResponse
    {
        // Preparer la donnée
        $showPut = $showRepo->find($id);

        // envoi d'une erreur si erreur
        if (is_null($showPut))
        {
            $info = [
                'success' => false,
                'error_message' => 'show non trouvé',
                'error_code' => 'show_not_found',
            ];

              // on récupère le json brut de la requete
              return $this->json($info, Response::HTTP_NOT_FOUND);
        }
         // on récupère le json brut de la requete
         $json = $request->getContent();

            $serializer->deserialize($json, Show::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $showPut]);

             // 2. validation des données
    
        $errors = $validator->validate($showPut);
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
       
        
           // 3. faire le traitement des données
        // ici insérer le genre en BDD
     
        $em->flush();

        return $this->json($showPut, Response::HTTP_OK, [], ["groups" => "show_browse"]);

    
    }
 

    #[Route('/show/delete/{id}/', name: 'show', requirements: ["id" => "\d+"], methods: "DELETE")]
    public function showDelete($id, ShowRepository $showRepo,  EntityManagerInterface $em): JsonResponse
    {
        // Preparer la donnée
        $showDelete = $showRepo->find($id);

        // envoi d'une erreur si erreur
        if (is_null($showDelete))
        {
            $info = [
                'success' => false,
                'error_message' => 'show non trouvé',
                'error_code' => 'show_not_found',
            ];

            // renvoyer la donnée sous format json
            return $this->json($info, Response::HTTP_NOT_FOUND);
        }

           // 3. faire le traitement des données
        // ici insérer le genre en BDD
        $em->persist($showDelete);
        $em->flush();

        return $this->json($showDelete->getShows(), 200, [], ["groups" => "show_browse"]);

    
    }
}
