<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trip;
use App\Form\AddCommentType;
use App\Repository\TripRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class TripController extends AbstractController
{
    #[Route('/trip', name: 'app_trip_browse', methods:"GET")]
    #[Route('/', name: 'app_trip_home', methods:"GET")]
    public function browse(TripRepository $tripRepo): Response
    {
        // 1. préparer les données
        // ici récupérer tous les trips
        // donc on veut faire un select => Repository
        $allTrips = $tripRepo->findAll();
        

        return $this->render('trip/browse.html.twig', [
            'tripList' => $allTrips,
        ]);
    }

    #[Route('/trip/{id}', name: 'app_trip_read', methods:"GET", requirements: ["id" => "\d+"])]
    public function read(Trip $trip): Response
    {
        // 1. préparer les données
        // ici récupérer le Trip qui a l'id fournit dans l'url
        //  a - on récupère l'id, on récupère un repository et on fait un find
        //    - il faut aussi penser à vérifier si l'élément a été trouvé
        // $trip = $tripRepo->find($id);
        // if (is_null($trip))
        // {
        //     throw new NotFoundHttpException('Voyage non trouvé');
        // }
        //  b - on demande de récupérer automatiquement un objet qui correspond à l'id
        //    - la page 404 est gérée automatiquement
        return $this->render('trip/read.html.twig', [
            'trip' => $trip,
        ]);
    }

    #[Route('/trip/{id}/comment', name: 'app_trip_add_comment', methods:["GET", "POST"], requirements: ["id" => "\d+"])]
    #[IsGranted('ROLE_USER')]
    public function addComment(Trip $trip, EntityManagerInterface $em, Request $request): Response
    {
        // on crée une entité
        $comment = new Comment();

        // on crée un formulaire 
        $commentForm = $this->createForm(AddCommentType::class);

        // on le relie à l'entité que l'on a créé
        $commentForm->setData($comment);

        // le composant formulaire 
        //  vérifie si la requete est en post
        //  si oui il récupère les données et remplit l'entité fournie dans setData
        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid())
        {
            $comment->setTrip($trip);
            $em->persist($comment);

            $em->flush();

            // todo ajouter un message flash

            return $this->redirectToRoute('app_trip_read', ["id" => $trip->getId()] );
        }

        return $this->render('trip/add_comment.html.twig', [
            'addCommentForm' => $commentForm
        ]);
    }
}
