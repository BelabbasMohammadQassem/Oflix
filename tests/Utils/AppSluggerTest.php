<?php

use App\Utils\AppSlugger;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AppSluggerTest extends KernelTestCase
{
    /**
     * @dataProvider appSlugProvider
     */
    public function testCreateSlug(string $valueToTest, string $expectedResult):void
    {

        // 1 récupérer un objet qui contient la fonction / méthode à tester
        // Object Under Test
        $out = new AppSlugger('-');
        // 2 exécuter le code

        $actualResult = $out->createSlug($valueToTest);
        // 3 comparer les résultat

        $this->assertEquals($expectedResult, $actualResult);
    }

    public static function appSlugProvider(): array
    {
        return [
            ["", ""],
            ["ABC", "abc"],
            ["  ABC ", "abc"],
            ["  A B C ", "a-b-c"],
            ["pizza\Hawaienne", "pizza-hawaienne"],
            ["pizza/Hawaienne", "pizza-hawaienne"],
            ["pizza!Hawaienne", "pizza-hawaienne"],
            ["pizza*Hawaienne", "pizza-hawaienne"],
            ["pizza}Hawaienne", "pizza-hawaienne"],
            ["pizza{Hawaienne", "pizza-hawaienne"],
            ["pizza#Hawaienne", "pizza-hawaienne"],
            ["pizza     Hawaienne", "pizza-hawaienne"],
            // ["pizza?Hawaienne", "pizza-hawaienne"], // rajouté après le signalement d'un bogue
        ];
    }
}
