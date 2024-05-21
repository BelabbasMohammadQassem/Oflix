<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SandboxController extends AbstractController
{
    #[Route('sandbox/', methods: "GET", name:"sandbox_homepage")]
    public function homepage ()
    {
        return $this->render('sandbox/homepage.html.twig');
    }
}
