<?php 

namespace App\Utils;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TimeConverter extends AbstractExtension
{

    public function getFilters(): array
    {
        return [
            new TwigFilter('min2hours', [$this, 'convertTime']),
        ];
    }

    /**
     * converts minutes to string
     *
     * @param integer $minutes
     * @return string
     */
    public function convertTime(int $minutes):string
    {
        $result = '';
        $nbHours = (int)($minutes / 60);

        $nbMinutes = $minutes - $nbHours * 60;
        /*
        nbrs de minutes / soixante pour avoir le nombres d'heure, 
        les décimales x 60 pour les minutes

        99 min

        99 / 60 => 1.65
        on récupère la partie entière

        99 minutes
        1 h 
        99 - 1 * 60 = 39
        */
        $result = "{$nbHours}h";
        if ($nbMinutes > 0) 
        {
            $result .= " {$nbMinutes}min";
        }


        return $result;
    }
}