<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Entity\Casting;
use App\Entity\Country;
use App\Entity\Season;
use App\Entity\Show;
use App\Entity\Type;
use App\Entity\Genre;
use App\Entity\Review;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use JulienDussaut\FakerPizza\PizzaProvider;

class AppFixtures extends Fixture
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        // pour utiliser un service dans un autre
        // on l'injecte par le constructeur
        // le Conteneur de service se chargera de faire le new pour nous.

        // on stocke alors cet objet dans une propriété
        // à laquelle on pourra accéder dans notre code
        $this->hasher = $hasher;
    }
    
    public function load(ObjectManager $em): void
    {
        $faker = Factory::create('fr_FR');
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Character($faker));
        $faker->addProvider(new PizzaProvider($faker));
        $faker->seed(806);

        $clearPassword = 'oflix';

        $userList = [
            [
                'email' => 'admin@oflix.fr',
                'pseudo' => 'admin',
                'password' => 'oflix',
                'roles' => ['ROLE_ADMIN'],
            ],
            [
                'email' => 'manager@oflix.fr',
                'pseudo' => 'manager',
                'password' => 'oflix',
                'roles' => ['ROLE_MANAGER'],
            ],
            [
                'email' => 'user@oflix.fr',
                'pseudo' => 'user',
                'password' => 'oflix',
                'roles' => ['ROLE_USER'],
            ],
            [
                'email' => 'julien@oflix.fr',
                'pseudo' => 'julien',
                'password' => 'oflix',
                'roles' => ['ROLE_USER'],
            ],
            [
                'email' => 'virginie@oflix.fr',
                'pseudo' => 'virginie',
                'password' => 'oflix',
                'roles' => ['ROLE_USER'],
            ],
        ];
        $userEntityList = [];
        foreach($userList as $currentUser)
        {
            $newUser = new User();
            $hashedPassword = $this->hasher->hashPassword($newUser, $currentUser['password']);
            
            $newUser->setEmail($currentUser['email']);
            $newUser->setPassword($hashedPassword);
            $newUser->setRoles($currentUser['roles']);
            $newUser->setPseudo($currentUser['pseudo']);
            $userEntityList[] = $newUser;
            $em->persist($newUser);
        }

        /***** Actor ******/
        $actorList = [
            ['Eric', 'Judor'],
            ['Jean Claude', 'Van Damne'],
            ['Jacky', 'Van Damne'],
            ['Jean', 'dujardin'],
            ['Kevin', 'Spacey'],
            ['Beyonce', 'Knowles'],
            ['Chirs', 'Pratt'],
            ['Tom', 'Cruise'],
            ['Tom', 'Hanks'],
            ['Scarlett', 'Johansson'],
            ['Robert', 'Downey Jr.'],
            ['Meryl', 'Streep'],
            ['Leonardo', 'DiCaprio'],
            ['Matthew', 'McConaughey'],
            ['Christian', 'Bale'],
            ['Al', 'Pacino'],
            ['Russell', 'Crowe'],
            ['Leonardo', 'DiCaprio'],
            ['Heath', 'Ledger'],
            ['Cillian', 'Murphy'],
            ['Michael', 'Caine'],
            ['Tom', 'Hanks'],
            ['Wesley', 'Snipes'],
            ['Jim', 'Carrey'],
            ['Jack', 'Gyllenhaal'],
            ['Kim', 'Kardashian'],
        ];

        $actorEntityList = [];
        foreach( $actorList as $currentActor)
        {
            $newActor = new Actor();
            $newActor->setFirstName($currentActor[0]);
            $newActor->setLastName($currentActor[1]);
            $actorEntityList[] = $newActor;
            $em->persist($newActor);
        }

        for($i = 0; $i < 20; $i++ )
        {
            $newActor = new Actor();
            $newActor->setFirstName($faker->firstName());
            $newActor->setLastName($faker->lastName());
            $actorEntityList[] = $newActor;
            $em->persist($newActor);
        }

        /***** COUNTRY ******/
        $countryList = [
            'France',
            'USA',
            'Canada',
            'Italie',
            'Espagne',
            'Portugal',
            'Brésil',
            'Bénin',
        ];

        $countryEntityList = [];
        foreach( $countryList as $currentCountry)
        {
            $newCountry = new Country();
            $newCountry->setName($currentCountry);
            $countryEntityList[] = $newCountry;
            $em->persist($newCountry);
        }

        /******** GENRE ********/
        $genreList = [
            'Action', 
            'Animation', 
            'Aventure', 
            'Comédie', 
            'Dessin animé', 
            'Documentaire', 
            'Drame', 
            'Espionnage', 
            'Famille', 
            'Fantastique', 
            'Historique', 
            'Policier', 
            'Romance', 
            'Science-fiction', 
            'Thriller', 
            'Western', 
        ];

        $genreEntityList = [];
        foreach( $genreList as $currentGenre)
        {
            $newGenre = new Genre();
            $newGenre->setName($currentGenre);
            $genreEntityList[] = $newGenre;
            $em->persist($newGenre);
        }

        /******* TYPES ********/
        // creation de types
        $typeTvShow = new Type();
        $typeTvShow->setName('Série');
        $em->persist($typeTvShow);

        $typeMovie = new Type();
        $typeMovie->setName('Film');
        $em->persist($typeMovie);

        /********* SHOW *******/
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
                'type' => 'Film'
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
            
            /***** LIAISON avec Country ******/
            $countryCount = $faker->numberBetween(1, count($countryEntityList));
            for ($countryIndex = 0; $countryIndex < $countryCount; $countryIndex++)
            {
                // sélectionne une country au hasard
                $countryToAdd = $countryEntityList[$faker->numberBetween(0, count($countryEntityList) - 1)];
                $show->addCountry($countryToAdd);
            }

            /***** LIAISON avec Genre ******/
            $genreCount = $faker->numberBetween(1, count($genreEntityList));
            for ($genreIndex = 0; $genreIndex < $genreCount; $genreIndex++)
            {
                // sélectionne une genre au hasard
                $genreToAdd = $genreEntityList[$faker->numberBetween(0, count($genreEntityList) - 1)];
                $show->addGenre($genreToAdd);
            }

            /***** LIAISON avec Casting ******/
            $castingCount = $faker->numberBetween(2, 10);
            for ($castingOrder = 1; $castingOrder <= $castingCount; $castingOrder++)
            {
                $newCasting = new Casting();
                $newCasting->setArtWork($show);
                $randomActorIndex = $faker->numberBetween(0, count($actorEntityList) - 1);
                $newCasting->setActor($actorEntityList[$randomActorIndex]);
                $newCasting->setRole($faker->character());
                $newCasting->setCreditOrder($castingOrder);

                $em->persist($newCasting);
            }

            /***** LIAISON avec Review ******/
            $reviewCount = $faker->numberBetween(0, 5);
            for ($reviewIndex = 0; $reviewIndex < $reviewCount; $reviewIndex++)
            {
                $newReview = new Review();
                $newReview->setArtWork($show);
                $randomUserIndex = $faker->numberBetween(0, count($userEntityList) - 1);
                $newReview->setUser($userEntityList[$randomUserIndex]);
                $newReview->setContent($faker->pizzaName() . $faker->text(50));
                // on choisit entre 1 et 5 reactions au hasard
                $reactions = $faker->randomElements(
                    ['cry', 'laugh', 'think', 'sleep', 'smile'], 
                    $faker->numberBetween(1, 5)
                );
                $newReview->setReactions($reactions);
                $newReview->setRating($faker->numberBetween(0, 5));
                /*
                 * faker ne génère que des objets datetime 
                 * notre objet attends un objet datetimeImmutable
                 * on utilise la fonction statique
                 * DatetimeImmutable::createFromMutable
                 * pour "convertir" la date en immutable
                 */
                $newReview->setWatchedAt(DateTimeImmutable::createFromMutable($faker->dateTimeThisCentury()));

                $em->persist($newReview);
            }

            /***** LIAISON avec Type ******/
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
                $nbSeason = $faker->numberBetween(2, 7);

                for($seasonNumber = 1; $seasonNumber <= $nbSeason; $seasonNumber++)
                {
                    $season = new Season();
                    $season->setNumber($seasonNumber);
                    $season->setEpisodeCount($faker->numberBetween(4, 24));
                    $season->setTvShow($show);

                    $em->persist($season);
                }
            }
            $em->persist($show);
        }

        $em->flush();
    }
}
