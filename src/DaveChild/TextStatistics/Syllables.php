<?php

namespace DaveChild\TextStatistics;

class Syllables
{

    // Specific common exceptions that don't follow the rule set below are handled individually
    // array of problem words (with word as key, syllable count as value).
    // Common reasons we need to override some words:
    //   - Trailing 'e' is pronounced
    //   - Portmanteaus
    static public $arrProblemWords = array(
         'abalone'          => 4
        ,'abare'            => 3
        ,'abed'             => 2
        ,'abruzzese'        => 4
        ,'abbruzzese'       => 4
        ,'aborigine'        => 5
        ,'acreage'          => 3
        ,'adame'            => 3
        ,'adieu'            => 2
        ,'adobe'            => 3
        ,'anemone'          => 4
        ,'apache'           => 3
        ,'aphrodite'        => 4
        ,'apostrophe'       => 4
        ,'ariadne'          => 4
        ,'cafe'             => 2
        ,'calliope'         => 4
        ,'catastrophe'      => 4
        ,'chile'            => 2
        ,'chloe'            => 2
        ,'circe'            => 2
        ,'coyote'           => 3
        ,'epitome'          => 4
        ,'forever'          => 3
        ,'gethsemane'       => 4
        ,'guacamole'        => 4
        ,'hyperbole'        => 4
        ,'jesse'            => 2
        ,'jukebox'          => 2
        ,'karate'           => 3
        ,'machete'          => 3
        ,'maybe'            => 2
        ,'people'           => 2
        ,'recipe'           => 3
        ,'sesame'           => 3
        ,'shoreline'        => 2
        ,'simile'           => 3
        ,'syncope'          => 3
        ,'tamale'           => 3
        ,'yosemite'         => 4
        ,'daphne'           => 2
        ,'eurydice'         => 4
        ,'euterpe'          => 3
        ,'hermione'         => 4
        ,'penelope'         => 4
        ,'persephone'       => 4
        ,'phoebe'           => 2
        ,'zoe'              => 2
    );

    // These syllables would be counted as two but should be one
    static public $arrSubSyllables = array(
         'cia(l|$)' // glacial, acacia
        ,'tia'
        ,'cius'
        ,'cious'
        ,'[^aeiou]giu'
        ,'[aeiouy][^aeiouy]ion'
        ,'iou'
        ,'sia$'
        ,'eous$'
        ,'[oa]gue$'
        ,'.[^aeiuoycgltdb]{2,}ed$'
        ,'.ely$'
        //,'[cg]h?ed?$'
        //,'rved?$'
        //,'[aeiouy][dt]es?$'
        //,'^[dr]e[aeiou][^aeiou]+$' // Sorts out deal, deign etc
        //,'[aeiouy]rse$' // Purse, hearse
        ,'^jua'
        //,'nne[ds]?$' // canadienne
        ,'uai' // acquainted
        ,'eau' // champeau
        //,'pagne[ds]?$' // champagne
        //,'[aeiouy][^aeiuoytdbcgrnzs]h?e[rsd]?$'
        // The following detects words ending with a soft e ending. Don't
        // mess with it unless you absolutely have to! The following
        // is a list of words you can use to test a new version of
        // this rule (add 'r', 's' and 'd' where possible to test
        // fully):
        //   - absolve
        //   - acquiesce
        //   - audience
        //   - ache
        //   - acquire
        //   - brunelle
        //   - byrne
        //   - canadienne
        //   - coughed
        //   - curved
        //   - champagne
        //   - designate
        //   - force
        //   - lace
        //   - late
        //   - lathe
        //   - make
        //   - relayed
        //   - scrounge
        //   - side
        //   - sideline
        //   - some
        //   - wide
        //   - taste
        ,'[aeiouy](b|c|ch|d|dg|f|g|gh|gn|k|l|ll|lv|m|mm|n|nc|ng|nn|p|r|rc|rn|rs|rv|s|sc|sk|sl|squ|ss|st|t|th|v|y|z)e$'
        // For soft e endings with a "d". Test words:
        //   - crunched
        //   - forced
        //   - hated
        //   - sided
        //   - sidelined
        //   - unexploded
        //   - unexplored
        //   - scrounged
        //   - squelched
        //   - forced
        ,'[aeiouy](b|c|ch|dg|f|g|gh|gn|k|l|lch|ll|lv|m|mm|n|nc|ng|nch|nn|p|r|rc|rn|rs|rv|s|sc|sk|sl|squ|ss|th|v|y|z)ed$'
        // For soft e endings with a "s". Test words:
        //   - absences
        //   - accomplices
        //   - acknowledges
        //   - advantages
        //   - byrnes
        //   - crunches
        //   - forces
        //   - scrounges
        //   - squelches
        ,'[aeiouy](b|ch|d|f|gh|gn|k|l|lch|ll|lv|m|mm|n|nch|nn|p|r|rn|rs|rv|s|sc|sk|sl|squ|ss|st|t|th|v|y)es$'
        ,'^busi$'
    );

    // These syllables would be counted as one but should be two
    static public $arrAddSyllables = array(
         '([^s]|^)ia'
        ,'riet'
        ,'dien' // audience
        ,'iu'
        ,'io'
        ,'eo($|[b-df-hj-np-tv-z])'
        ,'ii'
        ,'[ou]a$'
        ,'[aeiouym]bl$'
        ,'[aeiou]{3}'
        ,'[aeiou]y[aeiou]'
        ,'^mc'
        ,'ism$'
        ,'asm$'
        ,'thm$'
        ,'([^aeiouy])\1l$'
        ,'[^l]lien'
        ,'^coa[dglx].'
        ,'[^gq]ua[^auieo]'
        ,'dnt$'
        ,'uity$'
        ,'[^aeiouy]ie(r|st|t)$'
        ,'eings?$'
        ,'[aeiouy]sh?e[rsd]$'
        ,'iell'
        ,'dea$'
        ,'real' // real, cereal
        ,'[^aeiou]y[ae]' // bryan, byerley
        ,'gean$' // aegean
        ,'uen' // influence, affluence
    );

    // Single syllable prefixes and suffixes
    static public $arrAffix = array(
         '`^un`'
        ,'`^fore`'
        ,'`^ware`'
        ,'`^none?`'
        ,'`^out`'
        ,'`^post`'
        ,'`^sub`'
        ,'`^pre`'
        ,'`^pro`'
        ,'`^dis`'
        ,'`^side`'
        ,'`ly$`'
        ,'`less$`'
        ,'`some$`'
        ,'`ful$`'
        ,'`ers?$`'
        ,'`ness$`'
        ,'`cians?$`'
        ,'`ments?$`'
        ,'`ettes?$`'
        ,'`villes?$`'
        ,'`ships?$`'
        ,'`sides?$`'
        ,'`ports?$`'
        ,'`shires?$`'
        ,'`tion(ed)?$`'
    );

    // Double syllable prefixes and suffixes
    static public $arrDoubleAffix = array(
         '`^above`'
        ,'`^ant[ie]`'
        ,'`^counter`'
        ,'`^hyper`'
        ,'`^afore`'
        ,'`^agri`'
        ,'`^in[ft]ra`'
        ,'`^inter`'
        ,'`^over`'
        ,'`^semi`'
        ,'`^ultra`'
        ,'`^under`'
        ,'`^extra`'
        ,'`^dia`'
        ,'`^micro`'
        ,'`^mega`'
        ,'`^kilo`'
        ,'`^pico`'
        ,'`^nano`'
        ,'`^macro`'
        ,'`berry$`'
        ,'`woman$`'
        ,'`women$`'
    );

    // Triple syllable prefixes and suffixes
    static public $arrTripleAffix = array(
         '`ology$`'
        ,'`ologist$`'
        ,'`onomy$`'
        ,'`onomist$`'
    );

    /**
     * Returns the number of syllables in the word.
     * Based in part on Greg Fast's Perl module Lingua::EN::Syllables
     * @param   string  $strWord      Word to be measured
     * @param   string  $strEncoding  Encoding of text
     * @return  int
     */
    public static function syllableCount($strWord, $strEncoding = '')
    {

        // Trim whitespace
        $strWord = trim($strWord);

        // Check we have some letters
        if (Text::letterCount(trim($strWord), $strEncoding) == 0) {
            return 0;
        }

        // $debug is an array containing the basic syllable counting steps for
        // this word.
        $debug = array();
        $debug['Counting syllables for'] = $strWord;

        // Should be no non-alpha characters and lower case
        $strWord = preg_replace('`[^A-Za-z]`', '', $strWord);
        $strWord = Text::lowerCase($strWord, $strEncoding);

        // Check for problem words
        if (isset(self::$arrProblemWords[$strWord])) {
            return self::$arrProblemWords[$strWord];
        }
        // Try singular
        $singularWord = Pluralise::getSingular($strWord);
        if ($singularWord != $strWord) {
            if (isset(self::$arrProblemWords[$singularWord])) {
                return self::$arrProblemWords[$singularWord];
            }
        }

        $debug['After cleaning, lcase'] = $strWord;

        // Remove prefixes and suffixes and count how many were taken
        $strWord = preg_replace(self::$arrAffix, '', $strWord, -1, $intAffixCount);
        $strWord = preg_replace(self::$arrDoubleAffix, '', $strWord, -1, $intDoubleAffixCount);
        $strWord = preg_replace(self::$arrTripleAffix, '', $strWord, -1, $intTripleAffixCount);

        if (($intAffixCount + $intDoubleAffixCount + $intTripleAffixCount) > 0) {
            $debug['After Prefix and Suffix Removal'] = $strWord;
            $debug['Prefix and suffix counts'] = $intAffixCount . ' * 1 syllable, ' . $intDoubleAffixCount . ' * 2 syllables, ' . $intTripleAffixCount . ' * 3 syllables';
        }

        // Removed non-word characters from word
        $arrWordParts = preg_split('`[^aeiouy]+`', $strWord);
        $intWordPartCount = 0;
        foreach ($arrWordParts as $strWordPart) {
            if ($strWordPart <> '') {
                $debug['Counting (' . $intWordPartCount . ')'] = $strWordPart;
                $intWordPartCount++;
            }
        }

        // Some syllables do not follow normal rules - check for them
        // Thanks to Joe Kovar for correcting a bug in the following lines
        $intSyllableCount = $intWordPartCount + $intAffixCount + (2 * $intDoubleAffixCount) + (3 * $intTripleAffixCount);
        $debug['Syllables by Vowel Count'] = $intSyllableCount;

        foreach (self::$arrSubSyllables as $strSyllable) {
            $_intSyllableCount = $intSyllableCount;
            $intSyllableCount -= preg_match('`' . $strSyllable . '`', $strWord);
            if ($_intSyllableCount != $intSyllableCount) {
                $debug['Subtracting (' . $strSyllable . ')'] = $strSyllable;
            }
        }
        foreach (self::$arrAddSyllables as $strSyllable) {
            $_intSyllableCount = $intSyllableCount;
            $intSyllableCount += preg_match('`' . $strSyllable . '`', $strWord);
            if ($_intSyllableCount != $intSyllableCount) {
                $debug['Adding (' . $strSyllable . ')'] = $strSyllable;
            }
        }
        $intSyllableCount = ($intSyllableCount == 0) ? 1 : $intSyllableCount;

        $debug['Result'] = $intSyllableCount;

        return $intSyllableCount;
    }

    /**
     * Returns total syllable count for text.
     * @param   string  $strText      Text to be measured
     * @param   string  $strEncoding  Encoding of text
     * @return  int
     */
    public static function totalSyllables($strText, $strEncoding = '')
    {
        $intSyllableCount = 0;
        $arrWords = explode(' ', $strText);
        $intWordCount = count($arrWords);
        for ($i = 0; $i < $intWordCount; $i++) {
            $intSyllableCount += self::syllableCount($arrWords[$i], $strEncoding);
        }

        return $intSyllableCount;
    }

    /**
     * Returns average syllables per word for text.
     * @param   string  $strText      Text to be measured
     * @param   string  $strEncoding  Encoding of text
     * @return  int|float
     */
    public static function averageSyllablesPerWord($strText, $strEncoding = '')
    {
        $intSyllableCount = 0;
        $intWordCount = Text::wordCount($strText, $strEncoding);
        $arrWords = explode(' ', $strText);
        for ($i = 0; $i < $intWordCount; $i++) {
            $intSyllableCount += self::syllableCount($arrWords[$i], $strEncoding);
        }
        $averageSyllables = (Maths::bcCalc($intSyllableCount, '/', $intWordCount));
        return $averageSyllables;
    }

    /**
     * Returns the number of words with more than three syllables
     * @param   string  $strText                  Text to be measured
     * @param   bool    $blnCountProperNouns      Boolean - should proper nouns be included in words count
     * @param   string  $strEncoding  Encoding of text
     * @return  int
     */
    public static function wordsWithThreeSyllables($strText, $blnCountProperNouns = true, $strEncoding = '')
    {
        $intLongWordCount = 0;
        $intWordCount = Text::wordCount($strText, $strEncoding);
        $arrWords = explode(' ', $strText);
        for ($i = 0; $i < $intWordCount; $i++) {
            if (Syllables::syllableCount($arrWords[$i], $strEncoding) > 2) {
                if ($blnCountProperNouns) {
                    $intLongWordCount++;
                } else {
                    $strFirstLetter = Text::substring($arrWords[$i], 0, 1, $strEncoding);
                    if ($strFirstLetter !== Text::upperCase($strFirstLetter, $strEncoding)) {
                        // First letter is lower case. Count it.
                        $intLongWordCount++;
                    }
                }
            }
        }

        return $intLongWordCount;
    }

    /**
     * Returns the percentage of words with more than three syllables
     * @param   string  $strText      Text to be measured
     * @param   bool    $blnCountProperNouns      Boolean - should proper nouns be included in words count
     * @return  int|float
     */
    public static function percentageWordsWithThreeSyllables($strText, $blnCountProperNouns = true, $strEncoding = '')
    {
        $intWordCount = Text::wordCount($strText, $strEncoding);
        $intLongWordCount = self::wordsWithThreeSyllables($strText, $blnCountProperNouns, $strEncoding);
        $intPercentage = Maths::bcCalc(Maths::bcCalc($intLongWordCount, '/', $intWordCount), '*', 100);

        return $intPercentage;
    }
}
