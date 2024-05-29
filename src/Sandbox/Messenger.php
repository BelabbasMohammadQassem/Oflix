<?php


namespace App\Sandbox;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class Messenger
{

    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function generateMsg()
    {
        return $this->slugger->slug('Coucou ' . random_int(1, 1000));
    }
}