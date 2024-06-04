<?php

namespace App\Controller;

use App\Entity\Review;
use App\Entity\Show;
use App\Form\ReviewType;
use App\Repository\ShowRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/show/{id}/commenter', name: 'app_show_review_add', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function reviewAdd(EntityManagerInterface $em, Request $request, Show $show): Response
    {
        $review = new Review();


        $reviewForm = $this->createForm(ReviewType::class, $review);

        $reviewForm->handleRequest($request);

        if ($reviewForm->isSubmitted() && $reviewForm->isValid())
        {
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

//     // OFFICE

//     #[Route('/back/show', "app_list_listoffice", methods: "GET")]
//     public function listoffice(): Response {
//          // 1. préparation des données
//          require __DIR__ . '/../../sources/data.php';

//          // 2. appel la vue
//          return $this->render('back/show/listoffice.html.twig', [
//              'showList' => $shows
//          ]);
//     }

//     #[Route('/back/show/{id}', "app_read_listoffice", methods: "GET", requirements: ['id' => '\d+'])]
//     public function readoffice(): Response {
//          // 1. préparation des données
//          require __DIR__ . '/../../sources/data.php';

//          // 2. appel la vue
//          return $this->render('back/show/readoffice.html.twig', [
//              'showList' => $shows
//          ]);
//     }

//     #[Route('/back/show/{id}/edit', "app_edit_listoffice", methods: ["GET", "POST"], requirements: ['id' => '\d+'])]
//     public function editoffice(): Response {
//          // 1. préparation des données
//          require __DIR__ . '/../../sources/data.php';

//          // 2. appel la vue
//          return $this->render('back/show/editoffice.html.twig', [
//              'showList' => $shows
//          ]);
//     }


//     #[Route('/back/show/add', "app_add_listoffice", methods: ["GET", "POST"])]
//     public function addoffice(): Response {
//          // 1. préparation des données
//          require __DIR__ . '/../../sources/data.php';

//          // 2. appel la vue
//          return $this->render('back/show/addoffice.html.twig', [
//              'showList' => $shows
//          ]);
//     }


//     #[Route('/back/show/{id}', "app_delete_listoffice", methods: "GET", requirements: ['id' => '\d+'])]
//     public function deleteoffice(): Response {
//          // 1. préparation des données
//          require __DIR__ . '/../../sources/data.php';

//          // 2. appel la vue
//          return $this->render('back/show/readoffice.html.twig', [
//              'showList' => $shows
//          ]);
//     }
}
