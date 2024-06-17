<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Country;
use App\Entity\Tag;
use App\Entity\Trip;
use App\Entity\User;
use DateTime;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $countryObjectList = $this->loadCountries($manager);
        $tagObjectList = $this->loadTags($manager);
        $userObjectList = $this->loadUsers($manager);

        $trips = [
            [
                'name' => 'Voyage aux antilles',
                'desc' => 'La montagne, la plage, le soleil et le rhum',
                'dest' => 'Fort de France',
            ],
            [
                'name' => 'Hyper trail',
                'desc' => '10 km ... de denivellé',
                'dest' => 'Réunion',
            ],
            [
                'name' => 'Socle PHP',
                'desc' => 'Du code, de la musique et de l\'ananas',
                'dest' => 'Titre Pro',
            ],
            [
                'name' => 'Voyage au Groland',
                'desc' => 'On vous laisse la surprise',
                'dest' => 'Présipauté ',
            ],
        ];

        foreach ($trips as $currentTrip)
        {

            // [
            //     'name' => 'Voyage au Groland',
            //     'desc' => 'On vous laisse la surprise',
            //     'dest' => 'Présipauté ',
            // ],
            $trip = new Trip();
            $imgId = random_int(1, 400);
            $trip->setImg('https://picsum.photos/id/' . $imgId . '/800/600');
            $trip->setName($currentTrip['name']);
            $trip->setDescription($currentTrip['desc']);
            $trip->setDestination($currentTrip['dest']);
            $trip->setPrice(random_int(10, 2000));


            $nextDeparture = new DateTime();
            $delay = random_int(3, 30);
            $nextDeparture->modify('+' . $delay . ' days');
            $nextDepartureImmutable = DateTimeImmutable::createFromMutable($nextDeparture);
            $trip->setNextDeparture($nextDepartureImmutable);

            // jointure countries
            $countryCount = random_int(1, 4);
            for ($i = $countryCount; $i > 0; $i--)
            {
                $countryToAddIndex = random_int(0, count($countryObjectList) - 1);
                $countryToAdd = $countryObjectList[$countryToAddIndex];
                $trip->addCountry($countryToAdd);
            }

            // jointure tags
            $tagCount = random_int(1, 7);
            for ($i = $tagCount; $i > 0; $i--)
            {
                $tagToAddIndex = random_int(0, count($tagObjectList) - 1);
                $tagToAdd = $tagObjectList[$tagToAddIndex];
                $trip->addTag($tagToAdd);
            }

            // jointure comments
            $commentCount = random_int(1, 7);
            for ($i = $commentCount; $i > 0; $i--)
            {
                $newComment = new Comment();
                $newComment->setContent('commentaire ' . $i);
                $newComment->setTrip($trip);
                $newComment->setRating(random_int(1, 3));

                // on sélectionne un user au hasard pour l'associer au commentaire
                $userToAddIndex = random_int(0, count($userObjectList) - 1);
                $userToAdd = $userObjectList[$userToAddIndex];
                $newComment->setUser($userToAdd);

                $manager->persist($newComment);
            }

            $manager->persist($trip);
        }

        $manager->flush();
    }

    private function loadCountries(ObjectManager $manager)
    {
        $countries = [
            'France',
            'Allemagne',
            'Italie',
            'Espagne',
            'Portugal',
            'Suisse',
            'Grèce',
        ];

        $createdCountries = [];
        foreach($countries as $currentCountry)
        {
            $newCountry = new Country();
            $newCountry->setName($currentCountry);


            $createdCountries[] = $newCountry;
            $manager->persist($newCountry);
        }

        $manager->flush();

        return $createdCountries;
    }


    private function loadTags(ObjectManager $manager)
    {
        $tags = [
            'sport',
            'famille',
            'détente',
            'plage',
            'montagne',
            'randonnée',
            'nature',
        ];

        $createdTags = [];
        foreach($tags as $currentTag)
        {
            $newTag = new Tag();
            $newTag->setName($currentTag);


            $createdTags[] = $newTag;
            $manager->persist($newTag);
        }

        $manager->flush();

        return $createdTags;
    }


    private function loadUsers(ObjectManager $manager)
    {
        $users = [
            'Manu',
            'JP',
            'Vivi',
            'Kév',
            'Mous',
            'Nikko',
            'Clém',
            'Gwegz'
        ];

        $createdUsers = [];
        foreach($users as $currentUser)
        {
            $newUser = new User();
            $newUser->setUserName($currentUser);
            $newUser->setEmail($currentUser . '@tripodvisor.fr');
            $newUser->setRoles(['ROLE_USER']);
            // mdp : tripodvisor
            $newUser->setPassword('$2y$13$Os/WayK2hR5b6ZbtG42ek.yf.9VVLCM4nrvwadBuND3cNveaKzMVK');


            $createdUsers[] = $newUser;
            $manager->persist($newUser);
        }


        $newUser = new User();
        $newUser->setUserName('admin');

        $newUser->setEmail('admin@tripodvisor.fr');
        $newUser->setRoles(['ROLE_ADMIN']);
        // mdp : tripodvisor
        $newUser->setPassword('$2y$13$Os/WayK2hR5b6ZbtG42ek.yf.9VVLCM4nrvwadBuND3cNveaKzMVK');


        $createdUsers[] = $newUser;
        $manager->persist($newUser);

        $manager->flush();

        return $createdUsers;
    }
}
