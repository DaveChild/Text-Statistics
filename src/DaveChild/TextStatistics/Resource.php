<?php

namespace DaveChild\TextStatistics;

class Resource
{

    /**
     * Array containing the Spache word list, if set.
     * @var array|boolean
     */
    static protected $arrSpache = false;

    /**
     * Array containing the Dale-Chall word list, if set.
     * @var array|boolean
     */
    static protected $arrDaleChall = false;

    /**
     * Fetch the list of Spache easy words
     * @return array
     */
    public static function fetchSpacheWordList()
    {
        if (is_array(self::$arrSpache)) {
            return self::$arrSpache;
        }

        // Fetch Spache Words
        $arrSpacheWordList = array();
        include_once('resources/SpacheWordList.php');
        self::$arrSpache = $arrSpacheWordList;

        return $arrSpacheWordList;
    }

    /**
     * Fetch the list of Dale-Chall easy words
     * @return array
     */
    public static function fetchDaleChallWordList()
    {
        if (is_array(self::$arrDaleChall)) {
            return self::$arrDaleChall;
        }

        // Fetch Dale-Chall Words
        $arrDaleChallWordList = array();
        include_once('resources/DaleChallWordList.php');
        self::$arrDaleChall = $arrDaleChallWordList;

        return $arrDaleChallWordList;
    }
}
