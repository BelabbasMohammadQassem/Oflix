<?php

namespace App\Controller;

use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/sandbox', name:"sandbox_")]
class SandboxController extends AbstractController
{
    #[Route('/', methods: "GET", name:"homepage")]
    public function homepage ()
    {
        $age = random_int(8, 28);
        $totoPhp = new stdClass();
        $totoPhp->name = 'toto';


        return $this->render('sandbox/homepage.html.twig', [
            'age' => $age,
            'majeur' => $age >= 18,
            'liste_course' => ['pizza', 'ananas', 'creme', 'tomate'],
            'greg' => ['name' => 'gregoclock', 'hobbies' => ['capoeira', 'basket']],
            'xss_css' => '<style>body{background-color: #F0F;}</style>niark',
            'xss_js' => '<script>alert("niark");</script>niark',
            'toto' => $totoPhp
        ]);
    }

    #[Route('/session/write/', methods: "GET", name:"session_write")]
    public function demoSessionWrite(RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();

        $session->set('promo_name', 'nem');
        $session->set('promo_spe', 'symfo');
        dd($session);

        // redirection
    }

    #[Route('/session/read', methods: "GET", name:"session_read")]
    public function demoSessionRead(RequestStack $requestStack)
    {
        $session = $requestStack->getSession();

        $promoName = $session->get('promo_name', 'big bang');
        dd($promoName);

        // redirection
    }


    // /sandbox/session/ecrire/key/value
    // créer une route qui
    //   écrit dans la session à la clef key la valeur value

    #[Route('/session/ecrire/{key}/{value}', methods: "GET", name:"session_custom_write")]
    public function demoSessionReadCustomValue(RequestStack $requestStack, string $key, string $value)
    {
        $session = $requestStack->getSession();

        $promoName = $session->set($key, $value);

        $this->addFlash('success', 'valeurs ajoutées ' . $key . ' : ' . $value);
        // redirection

        return $this->redirectToRoute('sandbox_homepage');
    }
}