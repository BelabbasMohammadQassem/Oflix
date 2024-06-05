<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', "app_main_home", methods: "GET")]
    #[Route('/demo/toto', "app_main_demo", methods: "GET")]
    public function home(): Response
    {
        // 1. préparation des données
        require __DIR__ . '/../../sources/data.php';


        // 2. appel la vue
        return $this->render('main/home.html.twig', [
            'showList' => $shows
        ]);
    }
}
