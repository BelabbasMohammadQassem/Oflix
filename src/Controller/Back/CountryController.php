<?php

namespace App\Controller\Back;

use App\Entity\Country;
use App\Form\CountryType;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/back/country', name: 'app_back_country_')]
class CountryController extends AbstractController
{
    #[Route('/', name: 'browse', methods:'GET')]
    public function browse(CountryRepository $countryRepository): Response
    {
        // 1. préparer les données
        // ici récupérer tous les country

        $allCountrys = $countryRepository->findAll();


        return $this->render('back/country/browse.html.twig', [
            'countryList' => $allCountrys,
        ]);
    }

    #[Route('/{id<\d+>}', name: 'read', methods:'GET')]
    public function read(Country $country): Response
    {
        // 1. préparer les données

        return $this->render('back/country/read.html.twig', [
            'country' => $country,
        ]);
    }

    #[Route('/{id<\d+>}/update', name: 'edit', methods:['GET', 'POST'])]
    public function edit(EntityManagerInterface $em, Request $request, Country $country): Response
    {
        $form = $this->createForm(CountryType::class, $country);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->flush();
            $this->addFlash('success', 'Country modifié avec succès');

            return $this->redirectToRoute('app_back_country_read', ['id' => $country->getId()]);
        }

        return $this->render('back/country/edit.html.twig', [
            'form' => $form,
            'country' => $country,
        ]);
    }

    #[Route('/add', name: 'add', methods:['GET', 'POST'])]
    public function add(EntityManagerInterface $em, Request $request): Response
    {
        $country = new Country();

        $form = $this->createForm(CountryType::class, $country);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($country);
            $em->flush();

            $this->addFlash('success', 'Country ajouté avec succès');
            
            // todo si on créé une série rediriger l'utilisateur vers la page de gestions des saisons
            return $this->redirectToRoute('app_back_country_browse');
        }

        return $this->render('back/country/add.html.twig', [
            'form' => $form,
            'country' => $country,
        ]);
    }

    #[Route('/{id<\d+>}/delete', name: 'delete', methods:'GET')]
    public function delete(EntityManagerInterface $em, Country $country): Response
    {
        $em->remove($country);

        $em->flush();

        $this->addFlash('success', 'Suppression réussie');

        return $this->redirectToRoute('app_back_country_browse');
    }

}
