<?php

namespace App\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class MainController extends AbstractController
{
    #[Route('/back/', name: 'app_back_main_home', methods: 'GET')]
    #[IsGranted('ROLE_MANAGER')]
    public function home(): Response
    {

        // permet d'arreter l'exécution du code si l'utilisateur n'a pas le role admin
        // on peut aussi le faire avec un attribut sur toute la méthode
        $this->denyAccessUnlessGranted('ROLE_MANAGER');


        return $this->render('back/main/home.html.twig');
    }
}
