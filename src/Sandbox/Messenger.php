<?php


namespace App\Sandbox;

use App\Utils\TimeConverter;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class Messenger
{
    private $slugger;
    private $language;

    public function __construct(SluggerInterface $slugger, $language)
    {
        $this->slugger = $slugger;
        $this->language = $language;
    }
    
    public function generateMsg()
    {
        dump($this->language);
        return $this->slugger->slug('Coucou ' . random_int(1, 1000));
    }
}