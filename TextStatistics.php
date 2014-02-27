<?php

/*

    TextStatistics Class
    https://github.com/DaveChild/Text-Statistics

    Released under New BSD license
    http://www.opensource.org/licenses/bsd-license.php

    Calculates following readability scores (formulae can be found in wiki):
      * Flesch Kincaid Reading Ease
      * Flesch Kincaid Grade Level
      * Gunning Fog Score
      * Coleman Liau Index
      * SMOG Index
      * Automated Reability Index

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
    protected $strEncoding = ''; // Used to hold character encoding to be used by object, if set

    protected $blnMbstring = true; // Efficiency: Is the MB String extension loaded ?

    protected static $blnBcmath = true; // Efficiency: Is the BC Math extension loaded ?

    public $normalize = true;

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
     * Gives letter count (ignores all non-letters). Tries mb_strlen and if that fails uses regular strlen.
     * @param   string  $strText      Text to be measured
     * @return  int
     */
    public function letter_count($strText)
    {
        $strText = $this->clean_text($strText); // To clear out newlines etc
        $intTextLength = 0;
        $strText = preg_replace('/[^A-Za-z]+/', '', $strText);
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
     * Trims, removes line breaks, multiple spaces and generally cleans text before processing.
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

        // all these tags should be preceeded by a full stop.
        $fullStopTags = array('li', 'p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'dd');
        foreach ($fullStopTags as $tag) {
            $strText = str_ireplace('</'.$tag.'>', '.', $strText);
        }
        $strText = strip_tags($strText);
        $strText = preg_replace('/[",:;()-]/', ' ', $strText); // Replace commas, hyphens, quotes etc (count them as spaces)
        $strText = preg_replace('/[\.!?]/', '.', $strText); // Unify terminators
        $strText = trim($strText) . '.'; // Add final terminator, just in case it's missing.
        $strText = preg_replace('/[ ]*(\n|\r\n|\r)[ ]*/', ' ', $strText); // Replace new lines with spaces
        $strText = preg_replace('/([\.])[\. ]+/', '$1', $strText); // Check for duplicated terminators
        $strText = trim(preg_replace('/[ ]*([\.])/', '$1 ', $strText)); // Pad sentence terminators
        $strText = preg_replace('/ [0-9]+ /', ' ', ' ' . $strText . ' '); // Remove "words" comprised only of numbers
        $strText = preg_replace('/[ ]+/', ' ', $strText); // Remove multiple spaces
        $strText = preg_replace_callback('/\. [^ ]+?/', create_function('$matches', 'return strtolower($matches[0]);'), $strText); // Lower case all words following terminators (for gunning fog score)

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
        $intSentences = max(1, $this->text_length(preg_replace('/[^\.!?]/', '', $strText)));

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
        $intWords = 1 + $this->text_length(preg_replace('/[^ ]/', '', $strText)); // Space count + 1 is word count

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
        $strWord = preg_replace('/[^A-Za-z]/', '', $strWord);

        $intSyllableCount = 0;
        $strWord = $this->lower_case($strWord);

        // Specific common exceptions that don't follow the rule set below are handled individually
        // array of problem words (with word as key, syllable count as value)
        $arrProblemWords = array(
             'simile' => 3
            ,'forever' => 3
            ,'shoreline' => 2
        );
        if (isset($arrProblemWords[$strWord])) {
            return $arrProblemWords[$strWord];
        }

        // These syllables would be counted as two but should be one
        $arrSubSyllables = array(
             'cial'
            ,'tia'
            ,'cius'
            ,'cious'
            ,'giu'
            ,'ion'
            ,'iou'
            ,'sia$'
            ,'[^aeiuoyt]{2,}ed$'
            ,'.ely$'
            ,'[cg]h?e[rsd]?$'
            ,'rved?$'
            ,'[aeiouy][dt]es?$'
            ,'[aeiouy][^aeiouydt]e[rsd]?$'
            //,'^[dr]e[aeiou][^aeiou]+$' // Sorts out deal, deign etc
            ,'[aeiouy]rse$' // Purse, hearse
        );

        // These syllables would be counted as one but should be two
        $arrAddSyllables = array(
             'ia'
            ,'riet'
            ,'dien'
            ,'iu'
            ,'io'
            ,'ii'
            ,'[aeiouym]bl$'
            ,'[aeiou]{3}'
            ,'^mc'
            ,'ism$'
            ,'([^aeiouy])\1l$'
            ,'[^l]lien'
            ,'^coa[dglx].'
            ,'[^gq]ua[^auieo]'
            ,'dnt$'
            ,'uity$'
            ,'ie(r|st)$'
        );

        // Single syllable prefixes and suffixes
        $arrPrefixSuffix = array(
             '/^un/'
            ,'/^fore/'
            ,'/ly$/'
            ,'/less$/'
            ,'/ful$/'
            ,'/ers?$/'
            ,'/ings?$/'
        );

        // Remove prefixes and suffixes and count how many were taken
        $strWord = preg_replace($arrPrefixSuffix, '', $strWord, -1, $intPrefixSuffixCount);

        // Removed non-word characters from word
        $strWord = preg_replace('/[^a-z]/is', '', $strWord);
        $arrWordParts = preg_split('/[^aeiouy]+/', $strWord);
        $intWordPartCount = 0;
        foreach ($arrWordParts as $strWordPart) {
            if ($strWordPart <> '') {
                $intWordPartCount++;
            }
        }

        // Some syllables do not follow normal rules - check for them
        // Thanks to Joe Kovar for correcting a bug in the following lines
        $intSyllableCount = $intWordPartCount + $intPrefixSuffixCount;
        foreach ($arrSubSyllables as $strSyllable) {
            $intSyllableCount -= preg_match('/' . $strSyllable . '/', $strWord);
        }
        foreach ($arrAddSyllables as $strSyllable) {
            $intSyllableCount += preg_match('/' . $strSyllable . '/', $strWord);
        }
        $intSyllableCount = ($intSyllableCount == 0) ? 1 : $intSyllableCount;

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
}
