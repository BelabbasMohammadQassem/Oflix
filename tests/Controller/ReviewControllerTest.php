<?php

namespace App\Test\Controller;

use App\Entity\Review;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReviewControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/review/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Review::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Review index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'review[username]' => 'Testing',
            'review[email]' => 'Testing',
            'review[content]' => 'Testing',
            'review[rating]' => 'Testing',
            'review[reactions]' => 'Testing',
            'review[watchedAt]' => 'Testing',
            'review[artWork]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Review();
        $fixture->setUsername('My Title');
        $fixture->setEmail('My Title');
        $fixture->setContent('My Title');
        $fixture->setRating('My Title');
        $fixture->setReactions('My Title');
        $fixture->setWatchedAt('My Title');
        $fixture->setArtWork('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Review');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Review();
        $fixture->setUsername('Value');
        $fixture->setEmail('Value');
        $fixture->setContent('Value');
        $fixture->setRating('Value');
        $fixture->setReactions('Value');
        $fixture->setWatchedAt('Value');
        $fixture->setArtWork('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'review[username]' => 'Something New',
            'review[email]' => 'Something New',
            'review[content]' => 'Something New',
            'review[rating]' => 'Something New',
            'review[reactions]' => 'Something New',
            'review[watchedAt]' => 'Something New',
            'review[artWork]' => 'Something New',
        ]);

        self::assertResponseRedirects('/review/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getUsername());
        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getContent());
        self::assertSame('Something New', $fixture[0]->getRating());
        self::assertSame('Something New', $fixture[0]->getReactions());
        self::assertSame('Something New', $fixture[0]->getWatchedAt());
        self::assertSame('Something New', $fixture[0]->getArtWork());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Review();
        $fixture->setUsername('Value');
        $fixture->setEmail('Value');
        $fixture->setContent('Value');
        $fixture->setRating('Value');
        $fixture->setReactions('Value');
        $fixture->setWatchedAt('Value');
        $fixture->setArtWork('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/review/');
        self::assertSame(0, $this->repository->count([]));
    }
}
