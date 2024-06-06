<?php

namespace App\Controller\Back;

use App\Entity\Casting;
use App\Entity\Show;
use App\Form\CastingType;
use App\Repository\CastingRepository;
use App\Repository\ShowRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/back/casting', name: 'app_back_casting_')]
class CastingController extends AbstractController
{
    #[Route('/show/{showId<\d+>}', name: 'browse', methods:'GET')]
    public function browse(CastingRepository $castingRepository, $showId, 
    ShowRepository $showRepository): Response
    {
        $show = $showRepository->find($showId);
        if (is_null($show))
        {
            throw new NotFoundHttpException('Ce show n existe pas');
        }
        // 1. préparer les données
        // ici récupérer tous les casting
        $castingList = $castingRepository->findBy(['artWork' => $show], ['creditOrder' => 'ASC']);

        return $this->render('back/casting/browse.html.twig', [
            'castingList' => $castingList,
            'show' => $show
        ]);
    }

    #[Route('/{id<\d+>}', name: 'read', methods:'GET')]
    public function read(Casting $casting): Response
    {
        // 1. préparer les données

        return $this->render('back/casting/read.html.twig', [
            'casting' => $casting,
        ]);
    }

    #[Route('/{id<\d+>}/update', name: 'edit', methods:['GET', 'POST'])]
    public function edit(EntityManagerInterface $em, Request $request, Casting $casting): Response
    {
        $form = $this->createForm(CastingType::class, $casting);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->flush();
            $this->addFlash('success', 'Casting modifié avec succès');

            return $this->redirectToRoute('app_back_casting_read', ['id' => $casting->getId()]);
        }

        return $this->render('back/casting/edit.html.twig', [
            'form' => $form,
            'casting' => $casting,
        ]);
    }

    #[Route('/add/show/{showId<\d+>}', name: 'add', methods:['GET', 'POST'])]
    public function add(
        EntityManagerInterface $em, 
        Request $request,
        #[MapEntity(mapping: ['showId' => 'id'])]
        Show $show
    ): Response
    {
        $casting = new Casting();

        $form = $this->createForm(CastingType::class, $casting);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $casting->setArtWork($show);
            // todo soit calculer le crédit order

            $casting->setCreditOrder(count($show->getCastings()) + 1);
            $em->persist($casting);
            $em->flush();

            $this->addFlash('success', 'Casting ajouté avec succès');
            
            // todo si on créé une série rediriger l'utilisateur vers la page de gestions des saisons
            return $this->redirectToRoute('app_back_casting_browse', ['showId' => $show->getId()]);
        }

        return $this->render('back/casting/add.html.twig', [
            'form' => $form,
            'casting' => $casting,
            'show' => $show,
        ]);
    }

    #[Route('/{id<\d+>}/delete', name: 'delete', methods:'GET')]
    public function delete(EntityManagerInterface $em, Casting $casting): Response
    {
        $em->remove($casting);

        $em->flush();

        $this->addFlash('success', 'Suppression réussie');

        return $this->redirectToRoute('app_back_casting_browse', ['showId' => $casting->getArtWork()->getId()]);
    }

}
