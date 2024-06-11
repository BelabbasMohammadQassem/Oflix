<?php

namespace App\Utils;

class AppSlugger 
{
    private $separator;

    public function __construct(string $separator) 
    {
        $this->separator = $separator;
    }

    /**
     * creates a from a given string
     *
     * @param string $text
     * @return string
     */
    public function createSlug(string $text) :string
    {
        $forbiddenSymbols = [' ', '\\', '/', '[', ']', '%', '{', '}', '#', '*', '!', '?'];
        $result = $text;

        $result = trim($result);
       
        $previousSize = -1;
        while ($previousSize != strlen($result))
        {
            $previousSize = strlen($result);
            $result = str_replace('  ', ' ', $result);
        }
        /*
            décomposition de la bouble précédente avec 'a   b' dans result AVANT la boucle
            ligne previousSize    result    strlen(result)
              26       -1          'a   b'         5
              28       5           'a   b'         5
              29       5           'a  b'          4
              28       4           'a  b'          4
              29       4           'a b'           3
              28       3           'a b'           3
              29       3           'a b'           3
         */

        $result = str_replace($forbiddenSymbols, $this->separator, $result);
        $result = strtolower($result);

        /**
         * version avec expression régulière WIP
         */
        // $result = $text;
        // $result = trim($result);
        // $result = preg_replace('/\s+/', ' ', $result);
        // $result = preg_replace('/[^a-z0-9\s]/', '-', $result);
        return $result;
    }
}