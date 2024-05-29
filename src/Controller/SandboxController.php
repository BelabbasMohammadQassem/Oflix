<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Country;
use App\Entity\Genre;
use App\Entity\Season;
use App\Entity\Show;
use App\Entity\Type;
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
    
    
    #[Route('/populateDatabase', methods: "GET", name:"session_populate_database")]
    public function populateDatabase(EntityManagerInterface $em)
    {
        $countryList = [
            'France',
            'USA',
            'Canada',
        ];

        foreach( $countryList as $currentCountry)
        {
            $country = new Country();
            $country->setName($currentCountry);
            $em->persist($country);
        }

        // creation de types
        $typeTvShow = new Type();
        $typeTvShow->setName('Série');
        $em->persist($typeTvShow);

        $typeMovie = new Type();
        $typeMovie->setName('Film');
        $em->persist($typeMovie);

        $showList = [
            [
                'title' => 'Matrix',
                'releasedAt' => '1999-01-01',
                'poster' => '',
                'duration' => 15,
                'summary' => 'Neo dans la matrice',
                'synopsis' => 'Pillule bleue ou pillule rouge',
                'rating' => 5,
                'type' => 'Film',
            ],
            [
                'title' => 'Usual Suspects',
                'releasedAt' => '1995-01-01',
                'poster' => '',
                'duration' => 106,
                'summary' => 'Keyser Söze',
                'synopsis' => "Interrogé par la police à la suite de l\'explosion criminelle d\'un cargo, Verbal Kint se met à table : avec quatre autres gangsters, il s'est vu imposer une mission périlleuse par Keyser Söze, un malfrat craint de tous mais que personne ne connaît. Qui est ce mystérieux commanditaire ? Existe-t-il vraiment ?",
                'rating' => 5,
                'type' => 'Film',
            ],
            [
                'title' => 'The Matrix Reloaded',
                'releasedAt' => '2003-05-15',
                'poster' => '', 
                'duration' => 138,
                'summary' => 'Neo continues his fight against the machines.',
                'synopsis' => 'Neo and his allies race against time to unlock the secrets of the Matrix.',
                'rating' => 4,
                'type' => 'Film',
            ],
            [
                'title' => 'Le Fils du Mask',
                'releasedAt' => '2005-03-23',
                'poster' => '',
                'duration' => 15,
                'summary' => "Tim Avery, un dessinateur qui n'est pas prêt à être père, se retrouve contraint d'élever un bébé. Les pouvoirs que lui confère le masque de Loki lui permettront de mener à bien cette mission.",
                'synopsis' => 'La suite vraiment naze de The Mask',
                'rating' => 0,
                'type' => 'Film',
            ],
            [
                'title' => 'TC2000',
                'releasedAt' => '1993-01-01',
                'poster' => '',
                'duration' => 15,
                'summary' => 'Jason Storm, un gardien des territoires souterrain',
                'synopsis' => 'Un banger !',
                'rating' => 0,
                'type' => 'Film',
            ],
            [
                'title' => 'Yes Man',
                'releasedAt' => '2009-01-21',
                'poster' => '',
                'duration' => 103,
                'summary' => 'Carl découvre avec éblouissement le pouvoir magique du "Yes"',
                'synopsis' => "Le mieux peut être l'ennemi du bien, Carl va t il faire le bon choix?",
                'rating' => 4
            ],
            [
                'title' => 'The Matrix Revolutions',
                'releasedAt' => '2003-11-05',
                'poster' => '', 
                'duration' => 129,
                'summary' => 'The final battle for the fate of humanity.',
                'synopsis' => 'Neo faces his ultimate challenge as he battles against the machine army to save Zion.',
                'rating' => 3.5,
                'type' => 'Film',
            ],
            [
                'title' => '    Cars',
                'releasedAt' => '2006-06-14',
                'poster' => 'https://fr.web.img6.acsta.net/pictures/17/04/12/14/42/499210.jpg',
                'duration' => 60,
                'summary' => 'la course de Cars ',
                'synopsis' => 'la voiture rouge',
                'rating' => 4,5,
                'type' => 'Film',
            ],
            [
                'title' => 'Star Wars - Nouvel Espoir',
                'releasedAt' => '1977-01-01',
                'poster' => '',
                'duration' => 120,
                'summary' => 'Je suis ton pere',
                'synopsis' => 'Galaxy lointaine, très lointaine',
                'rating' => 5
            ],
            [
                'title' => 'Top Gun: Maverick',
                'releasedAt' => '2022-01-01',
                'poster' => 'https://fr.web.img3.acsta.net/pictures/22/03/29/15/12/0827894.jpg',
                'duration' => 131,
                'summary' => 'Le retour de Maverick',
                'synopsis' => 'Après plus de 30 ans de service en tant que l\'un des meilleurs aviateurs de la Marine, Pete "Maverick" Mitchell est à sa place, repoussant les limites en tant que pilote d\'essai courageux et esquivant l\'avancement de grade qui le mettrait à la terre. Entraînant de jeunes diplômés pour une mission spéciale, Maverick doit affronter les fantômes de son passé et ses peurs les plus profondes, aboutissant à une mission qui exige le sacrifice ultime de ceux qui choisissent de la piloter.',
                'rating' => 5
            ],
            [
                'title' => 'Le Mans 66',
                'releasedAt' => '2019-08-30',
                'poster' => 'https://fr.web.img6.acsta.net/c_310_420/pictures/19/10/14/09/06/5193325.jpg',
                'duration' => 153,
                'summary' => 'La course des 24h du Mans 1966',
                'synopsis' => "Basé sur une histoire vraie, le film suit une équipe d'excentriques ingénieurs américains menés par le visionnaire Carroll Shelby et son pilote britannique Ken Miles, qui sont envoyés par Henry Ford II pour construire à partir de rien une nouvelle automobile qui doit détrôner la Ferrari à la compétition du Mans de 1966.",
                'rating' => 4.3
            ],
            [
                'title' => 'Les Visiteurs',
                'releasedAt' => '1993-01-01',
                'poster' => '',
                'duration' => 107,
                'summary' => 'Les couloirs du temps ',
                'synopsis' => 'le vieux temps ',
                'rating' => 5,
                'type' => `Film`
            ],
            [          
                'title' => 'Brice de nice',
                'releasedAt' => '2005-05-06',
                'poster' => '',
                'duration' => 98,
                'summary' => 'Brice',
                'synopsis' => 'Surfe sur la vague',
                'rating' => 2,
            ],
            [
                'title' => 'Menteur Menteur',
                'releasedAt' => '1997-03-21',
                'poster' => '',
                'duration' => 86,
                'summary' => 'Un avocat, maudit pour dire la vérité pendant 24 heures.',
                'synopsis' => 'Fletcher Reede, un avocat volubile, se retrouve incapable de mentir pendant 24 heures à cause du vœu d’anniversaire de son fils.',
                'rating' => 4.5,
                'type' => 'Film',
            ],
            [
                'title' => 'American Beauty',
                'releasedAt' => '2000-02-02',
                'poster' => '',
                'duration' => 122,
                'summary' => 'La vie de Lester Burnhamm',
                'synopsis' => "Une maison de rêve, un pavillon bourgeois discrètement cossu dissimule dans une banlieue résidentielle, c'est ici que résident Lester Burnhamm, sa femme Carolyn et leur fille Jane. L'agitation du monde et sa violence semblent bien loin ici. Mais derrière cette respectable façade se tisse une étrange et grinçante tragi-comédie familiale ou désirs inavoués, frustrations et violences refoulées conduiront inexorablement un homme vers la mort",
                'rating' => 5
            ],
            [
                'title' => 'Vikings',
                'releasedAt' => '2013',
                'poster' => '',
                'duration' => 66,
                'summary' => 'Battle of the thrones.',
                'synopsis' => 'Vikings',
                'rating' => 5,
                'type' => 'série',
            ]
        ];

        foreach ($showList as $currentShowInfo)
        {
            $show = new Show();
            $show->setTitle($currentShowInfo['title']);
            $show->setReleasedAt(new DateTimeImmutable($currentShowInfo['releasedAt']));
            $show->setPoster($currentShowInfo['poster']);
            $show->setDuration($currentShowInfo['duration']);
            $show->setSummary($currentShowInfo['summary']);
            $show->setSynopsis($currentShowInfo['synopsis']);
            $show->setRating($currentShowInfo['rating']);
            $type = 'Film';

            if (isset($currentShowInfo['type']))
            {
                $type = $currentShowInfo['type'];
            }

            if ($type == 'Film')
            {
                $show->setType($typeMovie);
            }
            else
            {
                $show->setType($typeTvShow);
                $nbSeason = random_int(2, 7);

                for($seasonNumber = 1; $seasonNumber <= $nbSeason; $seasonNumber++)
                {
                    $season = new Season();
                    $season->setNumber($seasonNumber);
                    $season->setEpisodeCount(random_int(4, 24));
                    $season->setTvShow($show);

                    $em->persist($season);
                }
            }
            $em->persist($show);
        }

        $em->flush();
        return $this->redirectToRoute('app_main_home');
    }

}
