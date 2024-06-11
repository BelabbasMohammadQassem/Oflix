<?php

namespace App\Controller\Back;

use App\Entity\Show;
use App\Form\ShowType;
use App\Repository\ShowRepository;
use App\Utils\AppSlugger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/back/show', name: 'app_back_show_')]
class ShowController extends AbstractController
{
    #[Route('/', name: 'browse', methods:'GET')]
    public function browse(ShowRepository $showRepository): Response
    {
        // 1. préparer les données
        // ici récupérer tous les show

        $allShows = $showRepository->findAll();


        return $this->render('back/show/browse.html.twig', [
            'showList' => $allShows,
        ]);
    }

    #[Route('/{id<\d+>}', name: 'read', methods:'GET')]
    public function read(Show $show): Response
    {
        // 1. préparer les données

        return $this->render('back/show/read.html.twig', [
            'show' => $show,
        ]);
    }

    #[Route('/{id<\d+>}/update', name: 'edit', methods:['GET', 'POST'])]
    public function edit(AppSlugger $appSlugger, EntityManagerInterface $em, Request $request, Show $show): Response
    {
        $form = $this->createForm(ShowType::class, $show);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            // on sluggify le titre du show
            // le code est dans le service ( la classe ) AppSlugger
            // on récupère un objet de cette classe

            // on le fait par injection de dépendance, 
            // cela nous évite d'avoir à fournir les paramètres constructeur
            // $appSlugger = new AppSlugger('_');
            // et on slugify le titre
            $newSlug = $appSlugger->createSlug($show->getTitle());

            // on pense à l'enregistrer dans l'entité
            // car c'est l'entité qui nous sert de support pour modifier des données dans la BDD
            $show->setSlug($newSlug);
            $this->addFlash('success', 'Show modifié avec succès');
            
            // les modifications sont faites lors du flush
            $em->flush();

            return $this->redirectToRoute('app_back_show_read', ['id' => $show->getId()]);
        }

        return $this->render('back/show/edit.html.twig', [
            'form' => $form,
            'show' => $show,
        ]);
    }

    #[Route('/add', name: 'add', methods:['GET', 'POST'])]
    public function add(EntityManagerInterface $em, Request $request): Response
    {
        $show = new Show();

        $form = $this->createForm(ShowType::class, $show);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $show->setRating(2.5);
            $em->persist($show);
            $em->flush();

            $this->addFlash('success', 'Show ajouté avec succès');
            
            // todo si on créé une série rediriger l'utilisateur vers la page de gestions des saisons
            return $this->redirectToRoute('app_back_show_browse');
        }

        return $this->render('back/show/add.html.twig', [
            'form' => $form,
            'show' => $show,
        ]);
    }

    #[Route('/{id<\d+>}/delete', name: 'delete', methods:'GET')]
    public function delete(EntityManagerInterface $em, Show $show): Response
    {
        $em->remove($show);

        $em->flush();

        $this->addFlash('success', 'Suppression réussie');

        return $this->redirectToRoute('app_back_show_browse');
    }

}
