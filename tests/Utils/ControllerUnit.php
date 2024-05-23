<?php

use App\Utils\ShowControllerUnit;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


// Ici j'ai créer un nouveau fichier pour séparer les tests unitaires
// J'ai créer une nouvelle class pour pouvoir tester une autre fonction par exemple dans le controller comme celui de show par exemple



class ControllerUnitTest extends KernelTestCase {


 public fonction testUnitController (string $verifATester, string $verifAttendu) {
$showControllerUnit = new ShowControllerUnit();
$verifAttendu = $showControllerUnit->read($verifATester);

$this->assertEquals($verifAttendu, $verifATester);
}
}