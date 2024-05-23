<?php

use App\Utils\TimeConverter;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TimeConverterTest extends KernelTestCase
{

    /**
     * @dataProvider timeValuesProvider
     */
    public function testTimeConvert(int $valeurATester, string $resultatAttendu)
    {
        $timeConverter = new TimeConverter();

        $resultatObtenu = $timeConverter->convertTime($valeurATester);

        $this->assertEquals($resultatAttendu, $resultatObtenu);
    }

    public static function timeValuesProvider(): array
    {
        return [
            [60, '1h'],
            [99, '1h 39min'],
            [50, '50min'],
            [-1, 'n/a'],
            [1440, '1jour'],
            [1441, '1jour 1min'],
        ];
    }

    
}

