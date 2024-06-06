<?php

namespace App\Controller;

use App\Entity\Review;
use App\Entity\Show;
use App\Entity\User;
use App\Form\ReviewType;
use App\Repository\ShowRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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

    #[Route('/show/{id}/commenter', name: 'app_show_review_add', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function reviewAdd(EntityManagerInterface $em, Request $request, Show $show): Response
    {
        $review = new Review();


        $reviewForm = $this->createForm(ReviewType::class, $review);

        $reviewForm->handleRequest($request);

        if ($reviewForm->isSubmitted() && $reviewForm->isValid())
        {
            $review->setUser($this->getUser());
            $review->setArtWork($show);

            $em->persist($review);

            $em->flush();

            return $this->redirectToRoute('app_show_read', ["id" => $show->getId() ]);
        }



        return $this->render('show/reviewAdd.html.twig', 
        [
            'form' => $reviewForm,
        ]);
    }


    #[Route('show/review/{id}/edit', name: 'app_show_review_edit', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function reviewEdit(EntityManagerInterface $em, Request $request, Review $review): Response
    {
        $this->denyAccessUnlessGranted('REVIEW_EDIT', $review);
        // /** @var User $connectedUser */
        // $connectedUser = $this->getUser();
        // if (
        //     $connectedUser->getId() !== $review->getUser()->getId()
        //     && ! $this->isGranted('ROLE_ADMIN')
        // )
        // {
        //     // l'utilisateur connecté n'a pas créé la review
        //     // et ce n'est pas un admin
        //     throw new AccessDeniedException('vous n avez pas le droits');
        // }

        $reviewForm = $this->createForm(ReviewType::class, $review);

        $reviewForm->handleRequest($request);

        if ($reviewForm->isSubmitted() && $reviewForm->isValid())
        {

            $em->flush();

            return $this->redirectToRoute('app_show_read', ["id" => $review->getArtWork()->getId() ]);
        }

        return $this->render('show/reviewEdit.html.twig', 
        [
            'form' => $reviewForm,
        ]);
    }
}
