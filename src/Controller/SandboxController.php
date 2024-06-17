<?php

namespace App\Controller;

use App\Entity\Country;
use App\Form\CountryType;
use App\Repository\CountryRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SandboxController extends AbstractController
{
    #[Route('/sandbox/doctrine', name: 'app_sandbox_doctrine')]
    public function doctrine(CountryRepository $countryRepository): Response
    {
        $countryList = $countryRepository->findAll();

        return $this->render('sandbox/doctrine.html.twig', [
            'allCountryList' => $countryList,
        ]);
    }

    #[Route('/sandbox/form', name: 'app_sandbox_form', methods: ["POST", "GET"])]
    public function form(Request $request, EntityManagerInterface $em): Response
    {
        $country = new Country();
        $form = $this->createForm(CountryType::class, $country);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            // 3 traiter le formulaire
            $em->persist($country);

            $em->flush();

            // 4 rediriger
            return $this->redirectToRoute('app_sandbox_doctrine');
        }

        return $this->render('sandbox/form.html.twig', [
            'countryForm' => $form,
        ]);
    }
}
