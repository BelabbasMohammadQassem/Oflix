<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Entity\User;
use App\Repository\GenreRepository;
use App\Repository\ShowRepository;
use App\Repository\TypeRepository;
use App\Sandbox\Messenger;
use App\Utils\TimeConverter;
use DateTimeImmutable;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/sandbox', name:"sandbox_")]
class SandboxController extends AbstractController
{
    #[Route('/test', methods: "GET", name:"test")]
    public function testService (TimeConverter $timeConverter): Response
    {
        $valeurs = [
            '60' => '1h',
            '99' => '1h 39min',
            '50' => '50min',
            '-1' => 'n/a',
            '1440' => '1jour',
            '1441' => '1jour 1min'
        ];

        $result = [];
        foreach ($valeurs as $valeurATester => $resultatAttendu)
        {
            $resultatObtenu = $timeConverter->convertTime($valeurATester);
    
            if ($resultatAttendu != $resultatObtenu)
            {
                $result[] = [$valeurATester, $resultatAttendu, $resultatObtenu, 'KO'];
                break;
            }
            else
            {
                $result[] = [$valeurATester, $resultatAttendu, $resultatObtenu, 'ok'];
            }
        }


        return new JsonResponse($result);
    }

    #[Route('/service', methods: "GET", name:"service")]
    public function demoService (Messenger $messenger)
    {
        $msg = $messenger->generateMsg();


        // avec dépendance
        // RequestStack = new RequestStack();
        // $session
        // $messenger2 = new Messenger();

        dd($msg);

    }


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

    #[Route('/doctrine/browse/all', methods: "GET", name:"session_doctrine_browse_all")]
    public function doctrineBrowseAll(GenreRepository $genreRepository)
    {
        dump($genreRepository->findAll());
        // dump($genreRepository->find(1));
        // dump($genreRepository->findBy(['id' => 2]));
        // dump($genreRepository->findOneBy(['id' => 3]));

        return $this->render('sandbox/doctrine/browse.html.twig', [
            'genreList' => $genreRepository->findAll()
        ]);
    }

    #[Route('/doctrine/new', methods: "GET", name:"session_doctrine_new")]
    public function doctrineCreate(EntityManagerInterface $em)
    {
        // créer une entité
        $genre = new Genre();
        $genre->setName(uniqid("genre - "));

        // l'enregistrer en BDD
        // 1 - prévenir l'entity manager qu'un objet a été créé dans le code PHP
        $em->persist($genre);

        // 2 - exécuter les requetes
        $em->flush();

        return $this->redirectToRoute('sandbox_session_doctrine_browse_all');
    }


    #[Route('/doctrine/update/{id<\d+>}', methods: "GET", name:"session_doctrine_update")]
    public function doctrineUpdate(Genre $genre, EntityManagerInterface $em)
    {

        $genre->setName($genre->getName() . ' - update');

        $em->flush();

        return $this->redirectToRoute('sandbox_session_doctrine_browse_all');
    }


    #[Route('/doctrine/delete/{id<\d+>}', methods: "GET", name:"session_doctrine_delete")]
    public function doctrineDelete(int $id, GenreRepository $genreRepository, EntityManagerInterface $em)
    {
        $genre = $genreRepository->find($id);
        if (is_null($genre))
        {
            throw new NotFoundHttpException('Genre non trouvé');
        }

        $em->remove($genre);

        $em->flush();

        $this->addFlash('success', 'genre supprimé');

        return $this->redirectToRoute('sandbox_session_doctrine_browse_all');
    }

    #[Route('/association/browse', methods: "GET", name:"session_association_browse")]
    public function doctrineAssociation(TypeRepository $typeRepository)
    {
        return $this->render('sandbox/doctrine/association.html.twig', [
            'typeList' => $typeRepository->findAll()
        ]);
    }



    /**
     * Modifie le movie pour lui associer le type dont l'id est fourni dans l'url
     */
    #[Route('/association/{showId}/{typeId}', methods: "GET", name:"session_association_update")]
    public function doctrineAssociationUpdate(
        ShowRepository $showR, $showId, 
        TypeRepository $typeRepository, $typeId,
        EntityManagerInterface $em,
    )
    {
        // récupérer le show
        $show = $showR->find($showId);

        // récupérer le type
        $type = $typeRepository->find($typeId);

        // associer le nouveau type au movie
        $type->addShow($show);

        // applique les modif en BDD
        $em->flush();

        $this->addFlash('success', 'Show modifié');

        return $this->redirectToRoute('sandbox_session_association_browse');
    }

    #[Route('/hashpassword/{plaintextPassword}', methods: "GET", name:"hashPassword")]
    public function index(UserPasswordHasherInterface $passwordHasher, $plaintextPassword): Response
    {
        // ... e.g. get the user data from a registration form
        $user = new User();

        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );

        return new Response($hashedPassword);
    }
}
