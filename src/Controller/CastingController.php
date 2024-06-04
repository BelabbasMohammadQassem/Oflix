<?php

namespace App\Controller;

use App\Entity\Casting;
use App\Form\CastingType;
use App\Repository\CastingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/casting')]
class CastingController extends AbstractController
{
    #[Route('/', name: 'app_casting_index', methods: ['GET'])]
    public function index(CastingRepository $castingRepository): Response
    {
        return $this->render('casting/index.html.twig', [
            'castings' => $castingRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_casting_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $casting = new Casting();
        $form = $this->createForm(CastingType::class, $casting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($casting);
            $entityManager->flush();

            return $this->redirectToRoute('app_casting_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('casting/new.html.twig', [
            'casting' => $casting,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_casting_show', methods: ['GET'])]
    public function show(Casting $casting): Response
    {
        return $this->render('casting/show.html.twig', [
            'casting' => $casting,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_casting_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Casting $casting, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CastingType::class, $casting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_casting_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('casting/edit.html.twig', [
            'casting' => $casting,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_casting_delete', methods: ['POST'])]
    public function delete(Request $request, Casting $casting, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$casting->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($casting);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_casting_index', [], Response::HTTP_SEE_OTHER);
    }
}
