<?php

/*

    TextStatistics Class
    https://github.com/DaveChild/Text-Statistics

    Released under New BSD license
    http://www.opensource.org/licenses/bsd-license.php

    Calculates following readability scores (formulae can be found in Wikipedia):
      * Flesch Kincaid Reading Ease
      * Flesch Kincaid Grade Level
      * Gunning Fog Score
      * Coleman Liau Index
      * SMOG Index
      * Automated Reability Index
      * Dale-Chall Readability Score
      * Spache Readability Score

    Will also give:
      * String length
      * Letter count
      * Syllable count
      * Sentence count
      * Average words per sentence
      * Average syllables per word

    Sample Code
    ----------------
    $statistics = new TextStatistics;
    $text = 'The quick brown fox jumped over the lazy dog.';
    echo 'Flesch-Kincaid Reading Ease: ' . $statistics->flesch_kincaid_reading_ease($text);

*/

class TextStatistics
{
    /**
     * @var string $strEncoding Used to hold character encoding to be used
     * by object, if set
     */
    protected $strEncoding = '';

    /**
     * @var string $blnMbstring Efficiency: Is the MB String extension loaded?
     */
    protected $blnMbstring = true;

    /**
     * @var string $blnBcmath Efficiency: Is the BC Math extension loaded?
     */
    protected static $blnBcmath = true;

    /**
     * @var bool $normalize Should the result be normalized?
     */
    public $normalize = true;

    /**
     * @var bool $debug Debug mode shows the steps the syllable counter
     * goes through
     */
    public $debug = false;

    /**
     * @var array $arrDaleChall Holds the Dale-Chall words list, if set.
     */
    public $arrDaleChall = false;

    /**
     * @var array $arrSpache Holds the Spache words list, if set.
     */
    public $arrSpache = false;

    /**
     * Constructor.
     *
     * @param  string  $strEncoding Optional character encoding.
     * @return void
     */
    public function __construct($strEncoding = '')
    {
        if ($strEncoding <> '') {
            // Encoding is given. Use it!
            $this->strEncoding = $strEncoding;
        }

        $this->blnMbstring = extension_loaded('mbstring');
        self::$blnBcmath = extension_loaded('bcmath');
    }

    /**
     * Gives the Flesch-Kincaid Reading Ease of text entered rounded to one digit
     * @param   string  $strText         Text to be checked
     * @return  int|float
     */
    public function flesch_kincaid_reading_ease($strText)
    {
        $strText = $this->clean_text($strText);

        $score = self::bc_calc(self::bc_calc(206.835, '-', self::bc_calc(1.015, '*', $this->average_words_per_sentence($strText))), '-', self::bc_calc(84.6, '*', $this->average_syllables_per_word($strText)));

        return $this->normalize_score($score, 0, 100);
    }

    /**
     * Gives the Flesch-Kincaid Grade level of text entered rounded to one digit
     * @param   string  $strText         Text to be checked
     * @return  int|float
     */
    public function flesch_kincaid_grade_level($strText)
    {
        $strText = $this->clean_text($strText);

        $score = self::bc_calc(self::bc_calc(0.39, '*', $this->average_words_per_sentence($strText)), '+', self::bc_calc(self::bc_calc(11.8, '*', $this->average_syllables_per_word($strText)), '-', 15.59), true, 1);

        return $this->normalize_score($score, 0, 12);
    }

    /**
     * Gives the Gunning-Fog score of text entered rounded to one digit
     * @param   string  $strText         Text to be checked
     * @return  int|float
     */
    public function gunning_fog_score($strText)
    {
        $strText = $this->clean_text($strText);

        $score = self::bc_calc(self::bc_calc($this->average_words_per_sentence($strText), '+', $this->percentage_words_with_three_syllables($strText, false)), '*', '0.4');

        return $this->normalize_score($score, 0, 19);
    }

    /**
     * Gives the Coleman-Liau Index of text entered rounded to one digit
     * @param   string  $strText         Text to be checked
     * @return  int|float
     */
    public function coleman_liau_index($strText)
    {
        $strText = $this->clean_text($strText);

        $score = self::bc_calc(self::bc_calc(self::bc_calc(5.89, '*', self::bc_calc($this->letter_count($strText), '/', $this->word_count($strText))), '-', self::bc_calc(0.3, '*', self::bc_calc($this->sentence_count($strText), '/', $this->word_count($strText)))), '-', 15.8);

        return $this->normalize_score($score, 0, 12);
    }

    /**
     * Gives the SMOG Index of text entered rounded to one digit
     * @param   string  $strText         Text to be checked
     * @return  int|float
     */
    public function smog_index($strText)
    {
        $strText = $this->clean_text($strText);

        $score = self::bc_calc(1.043, '*', sqrt(self::bc_calc(self::bc_calc($this->words_with_three_syllables($strText), '*', self::bc_calc(30, '/', $this->sentence_count($strText))), '+', 3.1291)), true, 1);

        return $this->normalize_score($score, 0, 12);
    }

    /**
     * Gives the Automated Readability Index of text entered rounded to one digit
     * @param   string  $strText         Text to be checked
     * @return  int|float
     */
    public function automated_readability_index($strText)
    {
        $strText = $this->clean_text($strText);

        $score = self::bc_calc(self::bc_calc(4.71, '*', self::bc_calc($this->letter_count($strText), '/', $this->word_count($strText))), '+', self::bc_calc(self::bc_calc(0.5, '*', self::bc_calc($this->word_count($strText), '/', $this->sentence_count($strText))), '-', 21.43), true, 1);

        return $this->normalize_score($score, 0, 12);
    }

    /**
     * Gives the Dale-Chall readability score of text entered rounded to one digit
     * @param   string  $strText         Text to be checked
     * @return  int|float
     */
    public function dale_chall_readability_score($strText)
    {
        $strText = $this->clean_text($strText);

        $score = self::bc_calc(self::bc_calc(0.1579, '*', self::bc_calc(100, '*', self::bc_calc($this->dale_chall_difficult_word_count($strText), '/', $this->word_count($strText)))), '+', self::bc_calc(0.0496, '*', self::bc_calc($this->word_count($strText), '/', $this->sentence_count($strText))), true, 1);

        return $this->normalize_score($score, 0, 10);
    }


    /**
     * Gives the Spache readability score of text entered rounded to one digit
     * @param   string  $strText         Text to be checked
     * @return  int|float
     */
    public function spache_readability_score($strText)
    {
        $strText = $this->clean_text($strText);

        $score = self::bc_calc(self::bc_calc(self::bc_calc(self::bc_calc(0.121, '*', self::bc_calc($this->word_count($strText), '/', $this->sentence_count($strText))), '+', self::bc_calc(0.082, '*', $this->spache_difficult_word_count($strText))), '+', 0.659), true, 1);

        return $this->normalize_score($score, 0, 5); // Not really suitable for measuring readability above grade 4
    }

    /**
     * Gives string length. Tries mb_strlen and if that fails uses regular strlen.
     * @param   string  $strText      Text to be measured
     * @return  int
     */
    public function text_length($strText)
    {
        $intTextLength = 0;
        try {

            if (!$this->blnMbstring) {
                throw new Exception('The extension mbstring is not loaded.');
            }

            if ($this->strEncoding == '') {
                $intTextLength = mb_strlen($strText);
            } else {
                $intTextLength = mb_strlen($strText, $this->strEncoding);
            }
        } catch (Exception $e) {
            $intTextLength = strlen($strText);
        }

        return $intTextLength;
    }

    /**
     * Gives letter count (ignores all non-letters). Tries mb_strlen and if
     * that fails uses regular strlen.
     * @param   string  $strText      Text to be measured
     * @return  int
     */
    public function letter_count($strText)
    {
        $strText = $this->clean_text($strText); // To clear out newlines etc
        $intTextLength = 0;
        $strText = preg_replace('`[^A-Za-z]+`', '', $strText);
        try {

            if (!$this->blnMbstring) {
                throw new Exception('The extension mbstring is not loaded.');
            }

            if ($this->strEncoding == '') {
                $intTextLength = mb_strlen($strText);
            } else {
                $intTextLength = mb_strlen($strText, $this->strEncoding);
            }
        } catch (Exception $e) {
            $intTextLength = strlen($strText);
        }

        return $intTextLength;
    }

    /**
     * Trims, removes line breaks, multiple spaces and generally cleans text
     * before processing.
     * @param   string  $strText      Text to be transformed
     * @return  string
     */
    protected function clean_text($strText)
    {
        static $clean = array();

        $key = sha1($strText);

        if (isset($clean[$key])) {
            return $clean[$key];
        }

        $strText = utf8_decode($strText);

        // Curly quotes etc
        $strText = str_replace(array("\xe2\x80\x98", "\xe2\x80\x99", "\xe2\x80\x9c", "\xe2\x80\x9d", "\xe2\x80\x93", "\xe2\x80\x94", "\xe2\x80\xa6"), array("'", "'", '"', '"', '-', '--', '...'), $strText);
        $strText = str_replace(array(chr(145), chr(146), chr(147), chr(148), chr(150), chr(151), chr(133)), array("'", "'", '"', '"', '-', '--', '...'), $strText);

        // Replace periods within numbers
        $strText = preg_replace('`([^0-9][0-9]+)\.([0-9]+[^0-9])`mis', '${1}0$2', $strText);

        // Handle HTML. Treat block level elements as sentence terminators and
        // remove all other tags.
        $strText = preg_replace('`<script(.*?)>(.*?)</script>`is', '', $strText);
        $strText = preg_replace('`\</?(address|blockquote|center|dir|div|dl|dd|dt|fieldset|form|h1|h2|h3|h4|h5|h6|menu|noscript|ol|p|pre|table|ul|li)[^>]*>`is', '.', $strText);
        $strText = html_entity_decode($strText);
        $strText = strip_tags($strText);

        // Assume blank lines (i.e., paragraph breaks) end sentences (useful
        // for titles in plain text documents) and replace remaining new
        // lines with spaces
        $strText = preg_replace('`(\r\n|\n\r)`is', "\n", $strText);
        $strText = preg_replace('`(\r|\n){2,}`is', ".\n\n", $strText);
        $strText = preg_replace('`[ ]*(\n|\r\n|\r)[ ]*`', ' ', $strText);

        // Replace commas, hyphens, quotes etc (count as spaces)
        $strText = preg_replace('`[",:;()/\`-]`', ' ', $strText);

        // Unify terminators and spaces
        $strText = trim($strText, '. ') . '.'; // Add final terminator.
        $strText = preg_replace('`[\.!?]`', '.', $strText); // Unify terminators
        $strText = preg_replace('`([\.\s]*\.[\.\s]*)`mis', '. ', $strText); // Merge terminators separated by whitespace.
        $strText = preg_replace('`[ ]+`', ' ', $strText); // Remove multiple spaces
        $strText = preg_replace('`([\.])[\. ]+`', '$1', $strText); // Check for duplicated terminators
        $strText = trim(preg_replace('`[ ]*([\.])`', '$1 ', $strText)); // Pad sentence terminators

        // Lower case all words following terminators (for gunning fog score)
        $strText = preg_replace_callback('`\. [^\. ]`', create_function('$matches', 'return strtolower($matches[0]);'), $strText);

        $strText = trim($strText);

        // Cache it and return
        $clean[$key] = $strText;
        return $strText;
    }

    /**
     * Converts string to lower case. Tries mb_strtolower and if that fails uses regular strtolower.
     * @param   string  $strText      Text to be transformed
     * @return  string
     */
    protected function lower_case($strText)
    {
        $strLowerCaseText = '';
        try {

            if (!$this->blnMbstring) {
                throw new Exception('The extension mbstring is not loaded.');
            }

            if ($this->strEncoding == '') {
                $strLowerCaseText = mb_strtolower($strText);
            } else {
                $strLowerCaseText = mb_strtolower($strText, $this->strEncoding);
            }
        } catch (Exception $e) {
            $strLowerCaseText = strtolower($strText);
        }

        return $strLowerCaseText;
    }

    /**
     * Converts string to upper case. Tries mb_strtoupper and if that fails uses regular strtoupper.
     * @param   string  $strText      Text to be transformed
     * @return  string
     */
    protected function upper_case($strText)
    {
        $strUpperCaseText = '';
        try {

            if (!$this->blnMbstring) {
                throw new Exception('The extension mbstring is not loaded.');
            }

            if ($this->strEncoding == '') {
                $strUpperCaseText = mb_strtoupper($strText);
            } else {
                $strUpperCaseText = mb_strtoupper($strText, $this->strEncoding);
            }
        } catch (Exception $e) {
            $strUpperCaseText = strtoupper($strText);
        }

        return $strUpperCaseText;
    }

    /**
     * Gets portion of string. Tries mb_substr and if that fails uses regular substr.
     * @param   string  $strText      Text to be cut up
     * @param   int     $intStart     Start character
     * @param   int     $intLength    Length
     * @return  string
     */
    protected function substring($strText, $intStart, $intLength)
    {
        $strSubstring = '';
        try {

            if (!$this->blnMbstring) {
                throw new Exception('The extension mbstring is not loaded.');
            }

            if ($this->strEncoding == '') {
                $strSubstring = mb_substr($strText, $intStart, $intLength);
            } else {
                $strSubstring = mb_substr($strText, $intStart, $intLength, $this->strEncoding);
            }
        } catch (Exception $e) {
            $strSubstring = substr($strText, $intStart, $intLength);
        }

        return $strSubstring;
    }

    /**
     * Returns sentence count for text.
     * @param   string  $strText      Text to be measured
     * @return  int
     */
    public function sentence_count($strText)
    {
        if (strlen(trim($strText)) == 0) {
            return 0;
        }

        $strText = $this->clean_text($strText);
        // Will be tripped up by "Mr." or "U.K.". Not a major concern at this point.
        $intSentences = max(1, $this->text_length(preg_replace('`[^\.!?]`', '', $strText)));

        return $intSentences;
    }

    /**
     * Returns word count for text.
     * @param   string  $strText      Text to be measured
     * @return  int
     */
    public function word_count($strText)
    {
        if (strlen(trim($strText)) == 0) {
            return 0;
        }

        $strText = $this->clean_text($strText);
        // Will be tripped by em dashes with spaces either side, among other similar characters
        $intWords = 1 + $this->text_length(preg_replace('`[^ ]`', '', $strText)); // Space count + 1 is word count

        return $intWords;
    }

    /**
     * Returns average words per sentence for text.
     * @param   string  $strText      Text to be measured
     * @return  int|float
     */
    public function average_words_per_sentence($strText)
    {
        $strText = $this->clean_text($strText);
        $intSentenceCount = $this->sentence_count($strText);
        $intWordCount = $this->word_count($strText);

        return (self::bc_calc($intWordCount, '/', $intSentenceCount));
    }

    /**
     * Returns total syllable count for text.
     * @param   string  $strText      Text to be measured
     * @return  int
     */
    public function total_syllables($strText)
    {
        $strText = $this->clean_text($strText);
        $intSyllableCount = 0;
        $arrWords = explode(' ', $strText);
        $intWordCount = count($arrWords);
        for ($i = 0; $i < $intWordCount; $i++) {
            $intSyllableCount += $this->syllable_count($arrWords[$i]);
        }

        return $intSyllableCount;
    }

    /**
     * Returns average syllables per word for text.
     * @param   string  $strText      Text to be measured
     * @return  int|float
     */
    public function average_syllables_per_word($strText)
    {
        $strText = $this->clean_text($strText);
        $intSyllableCount = 0;
        $intWordCount = $this->word_count($strText);
        $arrWords = explode(' ', $strText);
        for ($i = 0; $i < $intWordCount; $i++) {
            $intSyllableCount += $this->syllable_count($arrWords[$i]);
        }
        return (self::bc_calc($intSyllableCount, '/', $intWordCount));
    }

    /**
     * Returns the number of words with more than three syllables
     * @param   string  $strText                  Text to be measured
     * @param   bool    $blnCountProperNouns      Boolean - should proper nouns be included in words count
     * @return  int
     */
    public function words_with_three_syllables($strText, $blnCountProperNouns = true)
    {
        $strText = $this->clean_text($strText);
        $intLongWordCount = 0;
        $intWordCount = $this->word_count($strText);
        $arrWords = explode(' ', $strText);
        for ($i = 0; $i < $intWordCount; $i++) {
            if ($this->syllable_count($arrWords[$i]) > 2) {
                if ($blnCountProperNouns) {
                    $intLongWordCount++;
                } else {
                    $strFirstLetter = $this->substring($arrWords[$i], 0, 1);
                    if ($strFirstLetter !== $this->upper_case($strFirstLetter)) {
                        // First letter is lower case. Count it.
                        $intLongWordCount++;
                    }
                }
            }
        }

        return ($intLongWordCount);
    }

    /**
     * Returns the number of words NOT on the Dale-Chall easy word list
     * @param   string  $strText                  Text to be measured
     * @return  int
     */
    public function dale_chall_difficult_word_count($strText)
    {
        $strText = $this->clean_text($strText);
        $intDifficultWordCount = 0;
        $arrWords = explode(' ', strtolower(preg_replace('`[^A-za-z\' ]`', '', $strText)));
        // Fetch Dale-Chall Words
        $this->fetchDaleChallWordList();
        for ($i = 0, $intWordCount = count($arrWords); $i < $intWordCount; $i++) {
            // Single letters are counted as easy
            if (strlen(trim($arrWords[$i])) < 2) {
                continue;
            }
            if ((!in_array(self::pluralise($arrWords[$i]), $this->arrDaleChall)) && (!in_array(self::unpluralise($arrWords[$i]), $this->arrDaleChall))) {
                $intDifficultWordCount++;
            }
        }

        return ($intDifficultWordCount);
    }

    /**
     * Fetch the list of Dale-Chall easy words
     * @return  int
     */
    public function fetchDaleChallWordList()
    {
        if ($this->arrDaleChall) {
            return $this->arrDaleChall;
        }

        // Fetch Dale-Chall Words
        include_once('resources/DaleChallWordList.php');
        $this->arrDaleChall = $arrDaleChallWordList;

        return true;
    }

    /**
     * Returns the number of unique words NOT on the Spache easy word list
     * @param   string  $strText                  Text to be measured
     * @return  int
     */
    public function spache_difficult_word_count($strText)
    {
        $strText = $this->clean_text($strText);
        $intDifficultWordCount = 0;
        $arrWords = explode(' ', strtolower(preg_replace('`[^A-za-z\' ]`', '', $strText)));
        // Fetch Spache Words
        $wordsCounted = array();
        $this->fetchSpacheWordList();
        for ($i = 0, $intWordCount = count($arrWords); $i < $intWordCount; $i++) {
            // Single letters are counted as easy
            if (strlen(trim($arrWords[$i])) < 2) {
                continue;
            }
            $singularWord = self::unpluralise($arrWords[$i]);
            if ((!in_array(self::pluralise($arrWords[$i]), $this->arrSpache)) && (!in_array($singularWord, $this->arrSpache))) {
                if (!in_array($singularWord, $wordsCounted)) {
                    $intDifficultWordCount++;
                    $wordsCounted[] = $singularWord;
                }
            }
        }

        return ($intDifficultWordCount);
    }

    /**
     * Fetch the list of Spache easy words
     * @return  int
     */
    public function fetchSpacheWordList()
    {
        if ($this->arrSpache) {
            return $this->arrSpache;
        }

        // Fetch Spache Words
        include_once('resources/SpachelWordList.php');
        $this->arrSpache = $arrSpacheWordList;

        return true;
    }


    /**
     * Returns the percentage of words with more than three syllables
     * @param   string  $strText      Text to be measured
     * @param   bool    $blnCountProperNouns      Boolean - should proper nouns be included in words count
     * @return  int|float
     */
    public function percentage_words_with_three_syllables($strText, $blnCountProperNouns = true)
    {
        $strText = $this->clean_text($strText);
        $intWordCount = $this->word_count($strText);
        $intLongWordCount = $this->words_with_three_syllables($strText, $blnCountProperNouns);
        $intPercentage = self::bc_calc(self::bc_calc($intLongWordCount, '/', $intWordCount), '*', 100);

        return ($intPercentage);
    }

    /**
     * Returns the number of syllables in the word.
     * Based in part on Greg Fast's Perl module Lingua::EN::Syllables
     * @param   string  $strWord      Word to be measured
     * @return  int
     */
    public function syllable_count($strWord)
    {
        if (strlen(trim($strWord)) == 0) {
            return 0;
        }

        // Should be no non-alpha characters
        $strWord = preg_replace('`[^A-Za-z]`', '', $strWord);

        $intSyllableCount = 0;
        $strWord = $this->lower_case($strWord);

        // Specific common exceptions that don't follow the rule set below are handled individually
        // array of problem words (with word as key, syllable count as value).
        // Common reasons we need to override some words:
        //   - Trailing 'e' is pronounced
        //   - Portmanteuas
        $arrProblemWords = array(
             'abalone' => 4
            ,'abare' => 3
            ,'abed' => 2
            ,'abruzzese' => 4
            ,'abbruzzese' => 4
            ,'aborigine' => 5
            ,'cafe' => 2
            ,'forever' => 3
            ,'people' => 2
            ,'jukebox' => 2
            ,'shoreline' => 2
            ,'simile' => 3
        );
        if (isset($arrProblemWords[$strWord])) {
            return $arrProblemWords[$strWord];
        }
        // Try singular
        $singularWord = self::unpluralise($strWord);
        if ($singularWord != $strWord) {
            if (isset($arrProblemWords[$singularWord])) {
                return $arrProblemWords[$singularWord];
            }
        }

        // These syllables would be counted as two but should be one
        $arrSubSyllables = array(
             'cia(l|$)' // glacial, acacia
            ,'tia'
            ,'cius'
            ,'cious'
            ,'giu'
            ,'[aeiouy][^aeiouy]ion'
            ,'iou'
            ,'sia$'
            ,'[^aeiuoycgltdb]{2,}ed$'
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
            ,'[aeiouy](b|c|ch|d|dg|f|g|gh|gn|k|l|ll|lv|m|mm|n|nc|ng|nn|p|r|rc|rn|rs|rv|s|sc|sk|sl|squ|ss|t|th|v|y)e$'
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
            ,'[aeiouy](b|c|ch|dg|f|g|gh|gn|k|l|lch|ll|lv|m|mm|n|nc|ng|nch|nn|p|r|rc|rn|rs|rv|s|sc|sk|sl|squ|ss|th|v|y)ed$'
            // For soft e endings with a "s". Test words:
            //   - absences
            //   - accomplices
            //   - acknowledges
            //   - byrnes
            //   - crunches
            //   - forces
            //   - scrounges
            //   - squelches
            ,'[aeiouy](b|ch|d|f|g|gh|gn|k|l|lch|ll|lv|m|mm|n|nch|nn|p|r|rn|rs|rv|s|sc|sk|sl|squ|ss|t|th|v|y)es$'
        );

        // These syllables would be counted as one but should be two
        $arrAddSyllables = array(
             '([^s]|^)ia'
            ,'riet'
            ,'dien' // audience
            ,'iu'
            ,'io'
            ,'eo'
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
        );

        // Single syllable prefixes and suffixes
        $arrPrefixSuffix = array(
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
        );

        // Double syllable prefixes and suffixes
        $arrDoublePrefixSuffix = array(
             '`^above`'
            ,'`^ant[ie]`'
            ,'`^counter`'
            ,'`^hyper`'
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
        $arrTriplePrefixSuffix = array(
             '`ology$`'
            ,'`ologist$`'
            ,'`onomy$`'
            ,'`onomist$`'
        );

        if ($this->debug) {
            echo '<pre>Counting syllables for: "' . $strWord . '"' . "\r\n";
        }

        // Remove prefixes and suffixes and count how many were taken
        $strWord = preg_replace($arrPrefixSuffix, '', $strWord, -1, $intPrefixSuffixCount);
        $strWord = preg_replace($arrDoublePrefixSuffix, '', $strWord, -1, $intDoublePrefixSuffixCount);
        $strWord = preg_replace($arrTriplePrefixSuffix, '', $strWord, -1, $intTriplePrefixSuffixCount);
        if ($this->debug) {
            if (($intPrefixSuffixCount + $intDoublePrefixSuffixCount + $intTriplePrefixSuffixCount) > 0) {
                echo 'After Prefix and Suffix Removal: "' . $strWord . '"' . "\r\n";
                echo '(' . $intPrefixSuffixCount . ' * 1 syllable, ' . $intDoublePrefixSuffixCount . ' * 2 syllables, ' . $intTriplePrefixSuffixCount . ' * 3 syllables)' . "\r\n";
            }
        }

        // Removed non-word characters from word
        $strWord = preg_replace('`[^a-z]`is', '', $strWord);
        $arrWordParts = preg_split('`[^aeiouy]+`', $strWord);
        $intWordPartCount = 0;
        foreach ($arrWordParts as $strWordPart) {
            if ($strWordPart <> '') {
                if ($this->debug) {
                    echo 'Counting: "' . $strWordPart . '"' . "\r\n";
                }
                $intWordPartCount++;
            }
        }

        // Some syllables do not follow normal rules - check for them
        // Thanks to Joe Kovar for correcting a bug in the following lines
        $intSyllableCount = $intWordPartCount + $intPrefixSuffixCount + (2 * $intDoublePrefixSuffixCount) + (3 * $intTriplePrefixSuffixCount);
        if ($this->debug) {
            echo 'Syllables by Vowel Count: "' . $intSyllableCount . '"' . "\r\n";
        }

        foreach ($arrSubSyllables as $strSyllable) {
            $_intSyllableCount = $intSyllableCount;
            $intSyllableCount -= preg_match('`' . $strSyllable . '`', $strWord);
            if ($this->debug) {
                if ($_intSyllableCount != $intSyllableCount) {
                    echo 'Subtracting: "' . $strSyllable . '"' . "\r\n";
                }
            }
        }
        foreach ($arrAddSyllables as $strSyllable) {
            $_intSyllableCount = $intSyllableCount;
            $intSyllableCount += preg_match('`' . $strSyllable . '`', $strWord);
            if ($this->debug) {
                if ($_intSyllableCount != $intSyllableCount) {
                    echo 'Adding: "' . $strSyllable . '"' . "\r\n";
                }
            }
        }
        $intSyllableCount = ($intSyllableCount == 0) ? 1 : $intSyllableCount;

        if ($this->debug) {
            echo 'Result: "' . $intSyllableCount . '".</pre>';
        }

        return $intSyllableCount;
    }

    /**
     * Normalizes score according to min & max allowed. If score larger
     * than max, max is returned. If score less than min, min is returned.
     * Also rounds result to specified precision.
     * Thanks to github.com/lvil.
     * @param   int|float  $score   Initial score
     * @param   int        $min     Minimum score allowed
     * @param   int        $max     Maximum score allowed
     * @return  int|float
     */
    public function normalize_score($score, $min, $max, $dps = 1)
    {
        $score = self::bc_calc($score, '+', 0, true, $dps); // Round
        if (!$this->normalize) {
            return $score;
        }
        if ($score > $max) {
            $score = $max;
        } elseif ($score < $min) {
            $score = $min;
        }

        return $score;
    }

    /**
     * Do simple reliable floating point calculations without the risk of wrong results
     * @see http://floating-point-gui.de/
     * @see the big red warning on http://php.net/language.types.float.php
     *
     * @source https://gist.github.com/jrfnl/8449978
     *
     * In the rare case that the bcmath extension would not be loaded, it will return the normal calculation results
     *
     * @param   mixed   $number1    Scalar (string/int/float/bool)
     * @param   string  $action        Calculation action to execute. Valid input:
     *                                '+' or 'add' or 'addition',
     *                                '-' or 'sub' or 'subtract',
     *                                '*' or 'mul' or 'multiply',
     *                                '/' or 'div' or 'divide',
     *                                '%' or 'mod' or 'modulus'
     *                                '=' or 'comp' or 'compare'
     * @param   mixed   $number2    Scalar (string/int/float/bool)
     * @param   bool    $round        Whether or not to round the result. Defaults to false.
     *                                Will be disregarded for a compare operation
     * @param   int     $decimals    Decimals for rounding operation. Defaults to 0.
     * @param   int     $precision    Calculation precision. Defaults to 10.
     * @return  mixed                Calculation result or false if either or the numbers isn't scalar or
     *                                an invalid operation was passed
     *                                - for compare the result will always be an integer
     *                                - for all other operations, the result will either be an integer
     *                                 (preferred) or a float
     */
    public static function bc_calc($number1, $action, $number2, $round = false, $decimals = 0, $precision = 10)
    {
        if (!is_scalar($number1) || !is_scalar($number2)) {
            return false;
        }

        if (self::$blnBcmath) {
            $number1 = strval($number1);
            $number2 = strval($number2);
        }

        $result  = null;
        $compare = false;

        switch ($action) {
            case '+':
            case 'add':
            case 'addition':
                $result = (self::$blnBcmath) ? bcadd($number1, $number2, $precision) /* string */ : ($number1 + $number2);
                break;
            case '-':
            case 'sub':
            case 'subtract':
                $result = (self::$blnBcmath) ? bcsub($number1, $number2, $precision) /* string */ : ($number1 - $number2);
                break;
            case '*':
            case 'mul':
            case 'multiply':
                $result = (self::$blnBcmath) ? bcmul($number1, $number2, $precision) /* string */ : ($number1 * $number2);
                break;
            case '/':
            case 'div':
            case 'divide':
                if (self::$blnBcmath) {
                    $result = bcdiv($number1, $number2, $precision); // string, or NULL if right_operand is 0
                } else if ($number2 != 0) {
                    $result = $number1 / $number2;
                }

                if (!isset($result)) {
                    $result = 0;
                }
                break;
            case '%':
            case 'mod':
            case 'modulus':
                if (self::$blnBcmath) {
                    $result = bcmod($number1, $number2, $precision); // string, or NULL if modulus is 0.
                } else if ($number2 != 0) {
                    $result = $number1 % $number2;
                }

                if (!isset($result)) {
                    $result = 0;
                }
                break;
            case '=':
            case 'comp':
            case 'compare':
                $compare = true;
                if (self::$blnBcmath) {
                    $result = bccomp($number1, $number2, $precision); // returns int 0, 1 or -1
                } else {
                    $result = ($number1 == $number2) ? 0 : (($number1 > $number2) ? 1 : -1);
                }
                break;
        }

        if (isset($result)) {
            if ($compare === false) {
                if ($round === true) {
                    $result = round(floatval($result), $decimals);
                    if ($decimals === 0) {
                        $result = (int) $result;
                    }
                } else {
                    $result = (intval($result) == $result) ? intval($result) : floatval($result);
                }
            }
            return $result;
        }

        return false;
    }

    /**
     * Singularising and Pluralising functions from following URL, released
     * under an MIT license and used with thanks:
     * http://kuwamoto.org/2007/12/17/improved-pluralizing-in-php-actionscript-and-ror/
     */
    private static $plural = array(
        '/(quiz)$/i'               => "$1zes",
        '/^(ox)$/i'                => "$1en",
        '/([m|l])ouse$/i'          => "$1ice",
        '/(matr|vert|ind)ix|ex$/i' => "$1ices",
        '/(x|ch|ss|sh)$/i'         => "$1es",
        '/([^aeiouy]|qu)y$/i'      => "$1ies",
        '/(hive)$/i'               => "$1s",
        '/(?:([^f])fe|([lr])f)$/i' => "$1$2ves",
        '/(shea|lea|loa|thie)f$/i' => "$1ves",
        '/sis$/i'                  => "ses",
        '/([ti])um$/i'             => "$1a",
        '/(tomat|potat|ech|her|vet)o$/i'=> "$1oes",
        '/(bu)s$/i'                => "$1ses",
        '/(alias)$/i'              => "$1es",
        '/(octop)us$/i'            => "$1i",
        '/(ax|test)is$/i'          => "$1es",
        '/(us)$/i'                 => "$1es",
        '/s$/i'                    => "s",
        '/$/'                      => "s"
    );

    private static $singular = array(
        '/(quiz)zes$/i'             => "$1",
        '/(matr)ices$/i'            => "$1ix",
        '/(vert|ind)ices$/i'        => "$1ex",
        '/^(ox)en$/i'               => "$1",
        '/(alias)es$/i'             => "$1",
        '/(octop|vir)i$/i'          => "$1us",
        '/(cris|ax|test)es$/i'      => "$1is",
        '/(shoe)s$/i'               => "$1",
        '/(o)es$/i'                 => "$1",
        '/(bus)es$/i'               => "$1",
        '/([m|l])ice$/i'            => "$1ouse",
        '/(x|ch|ss|sh)es$/i'        => "$1",
        '/(m)ovies$/i'              => "$1ovie",
        '/(s)eries$/i'              => "$1eries",
        '/([^aeiouy]|qu)ies$/i'     => "$1y",
        '/([lr])ves$/i'             => "$1f",
        '/(tive)s$/i'               => "$1",
        '/(hive)s$/i'               => "$1",
        '/(li|wi|kni)ves$/i'        => "$1fe",
        '/(shea|loa|lea|thie)ves$/i'=> "$1f",
        '/(^analy)ses$/i'           => "$1sis",
        '/((a)naly|(b)a|(d)iagno|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i'  => "$1$2sis",
        '/([ti])a$/i'               => "$1um",
        '/(n)ews$/i'                => "$1ews",
        '/(h|bl)ouses$/i'           => "$1ouse",
        '/(corpse)s$/i'             => "$1",
        '/(us)es$/i'                => "$1",
        '/s$/i'                     => ""
    );

    private static $irregular = array(
        'move'   => 'moves',
        'foot'   => 'feet',
        'goose'  => 'geese',
        'sex'    => 'sexes',
        'child'  => 'children',
        'man'    => 'men',
        'tooth'  => 'teeth',
        'person' => 'people'
    );

    private static $uncountable = array(
        'sheep',
        'fish',
        'deer',
        'beef',
        'css',
        'cs',
        'series',
        'species',
        'money',
        'rice',
        'information',
        'equipment'
    );

    public static function pluralise($string)
    {
        // save some time in the case that singular and plural are the same
        if (in_array(strtolower($string), self::$uncountable)) {
            return $string;
        }

        // check for irregular singular forms
        foreach (self::$irregular as $pattern => $result) {
            $pattern = '/' . $pattern . '$/i';
            if (preg_match($pattern, $string)) {
                return preg_replace($pattern, $result, $string);
            }
        }

        // check for matches using regular expressions
        foreach (self::$plural as $pattern => $result) {
            if (preg_match($pattern, $string)) {
                return preg_replace($pattern, $result, $string);
            }
        }

        return $string;
    }

    public static function unpluralise($string)
    {
        // save some time in the case that singular and plural are the same
        if (in_array(strtolower($string), self::$uncountable)) {
            return $string;
        }

        // check for irregular plural forms
        foreach (self::$irregular as $result => $pattern) {
            $pattern = '/' . $pattern . '$/i';
            if (preg_match($pattern, $string)) {
                return preg_replace($pattern, $result, $string);
            }
        }

        // check for matches using regular expressions
        foreach (self::$singular as $pattern => $result) {
            if (preg_match($pattern, $string)) {
                return preg_replace($pattern, $result, $string);
            }
        }

        return $string;
    }
}
