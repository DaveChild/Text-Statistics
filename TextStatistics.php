<?php

    /*

        TextStatistics Class
        http://code.google.com/p/php-text-statistics/

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

    class TextStatistics {

        protected $strEncoding = ''; // Used to hold character encoding to be used by object, if set

        /**
         * Constructor.
         *
         * @param string  $strEncoding    Optional character encoding.
         * @return void
         */
        public function __construct($strEncoding = '') {
            if ($strEncoding <> '') {
                // Encoding is given. Use it!
                $this->strEncoding = $strEncoding;
            }
        }

        /**
         * Gives the Flesch-Kincaid Reading Ease of text entered rounded to one digit
         * @param   strText         Text to be checked
         */
        function flesch_kincaid_reading_ease($strText) {
            $strText = $this->clean_text($strText);
            return round((206.835 - (1.015 * $this->average_words_per_sentence($strText)) - (84.6 * $this->average_syllables_per_word($strText))), 1);
        }

        /**
         * Gives the Flesch-Kincaid Grade level of text entered rounded to one digit
         * @param   strText         Text to be checked
         */
        function flesch_kincaid_grade_level($strText) {
            $strText = $this->clean_text($strText);
            return round(((0.39 * $this->average_words_per_sentence($strText)) + (11.8 * $this->average_syllables_per_word($strText)) - 15.59), 1);
        }

        /**
         * Gives the Gunning-Fog score of text entered rounded to one digit
         * @param   strText         Text to be checked
         */
        public function gunning_fog_score($strText) {
            $strText = $this->clean_text($strText);
            return round((($this->average_words_per_sentence($strText) + $this->percentage_words_with_three_syllables($strText, false)) * 0.4), 1);
        }

        /**
         * Gives the Coleman-Liau Index of text entered rounded to one digit
         * @param   strText         Text to be checked
         */
        public function coleman_liau_index($strText) {
            $strText = $this->clean_text($strText);
            return round( ( (5.89 * ($this->letter_count($strText) / $this->word_count($strText))) - (0.3 * ($this->sentence_count($strText) / $this->word_count($strText))) - 15.8 ), 1);
        }

        /**
         * Gives the SMOG Index of text entered rounded to one digit
         * @param   strText         Text to be checked
         */
        public function smog_index($strText) {
            $strText = $this->clean_text($strText);
            return round(1.043 * sqrt(($this->words_with_three_syllables($strText) * (30 / $this->sentence_count($strText))) + 3.1291), 1);
        }

        /**
         * Gives the Automated Readability Index of text entered rounded to one digit
         * @param   strText         Text to be checked
         */
        public function automated_readability_index($strText) {
            $strText = $this->clean_text($strText);
            return round(((4.71 * ($this->letter_count($strText) / $this->word_count($strText))) + (0.5 * ($this->word_count($strText) / $this->sentence_count($strText))) - 21.43), 1);
        }

        /**
         * Gives string length. Tries mb_strlen and if that fails uses regular strlen.
         * @param   strText      Text to be measured
         */
        public function text_length($strText) {
            $intTextLength = 0;
            try {
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
         * @param   strText      Text to be measured
         */
        public function letter_count($strText) {
            $strText = $this->clean_text($strText); // To clear out newlines etc
            $intTextLength = 0;
            $strText = preg_replace('/[^A-Za-z]+/', '', $strText);
            try {
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
         * @param   strText      Text to be transformed
         */
        protected function clean_text($strText) {
            // all these tags should be preceeded by a full stop. 
            $fullStopTags = array('li', 'p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'dd');
            foreach ($fullStopTags as $tag) {
                $strText = str_ireplace('</'.$tag.'>', '.', $strText);
            }
            $strText = strip_tags($strText);
            $strText = preg_replace('/[,:;()-]/', ' ', $strText); // Replace commans, hyphens etc (count them as spaces)
            $strText = preg_replace('/[\.!?]/', '.', $strText); // Unify terminators
            $strText = trim($strText) . '.'; // Add final terminator, just in case it's missing.
            $strText = preg_replace('/[ ]*(\n|\r\n|\r)[ ]*/', ' ', $strText); // Replace new lines with spaces
            $strText = preg_replace('/([\.])[\. ]+/', '$1', $strText); // Check for duplicated terminators
            $strText = trim(preg_replace('/[ ]*([\.])/', '$1 ', $strText)); // Pad sentence terminators
            $strText = preg_replace('/[ ]+/', ' ', $strText); // Remove multiple spaces
            $strText = preg_replace_callback('/\. [^ ]+/', create_function('$matches', 'return strtolower($matches[0]);'), $strText); // Lower case all words following terminators (for gunning fog score)
            return $strText;
        }

        /**
         * Converts string to lower case. Tries mb_strtolower and if that fails uses regular strtolower.
         * @param   strText      Text to be transformed
         */
        protected function lower_case($strText) {
            $strLowerCaseText = '';
            try {
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
         * @param   strText      Text to be transformed
         */
        protected function upper_case($strText) {
            $strUpperCaseText = '';
            try {
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
         * @param   strText      Text to be cut up
         * @param   intStart     Start character
         * @param   intLenght    Length
         */
        protected function substring($strText, $intStart, $intLength) {
            $strSubstring = '';
            try {
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
         * @param   strText      Text to be measured
         */
        public function sentence_count($strText) {
            $strText = $this->clean_text($strText);
            // Will be tripped up by "Mr." or "U.K.". Not a major concern at this point.
            $intSentences = max(1, $this->text_length(preg_replace('/[^\.!?]/', '', $strText)));
            return $intSentences;
        }

        /**
         * Returns word count for text.
         * @param   strText      Text to be measured
         */
        public function word_count($strText) {
            $strText = $this->clean_text($strText);
            // Will be tripped by by em dashes with spaces either side, among other similar characters
            $intWords = 1 + $this->text_length(preg_replace('/[^ ]/', '', $strText)); // Space count + 1 is word count
            return $intWords;
        }

        /**
         * Returns average words per sentence for text.
         * @param   strText      Text to be measured
         */
        public function average_words_per_sentence($strText) {
            $strText = $this->clean_text($strText);
            $intSentenceCount = $this->sentence_count($strText);
            $intWordCount = $this->word_count($strText);
            return ($intWordCount / $intSentenceCount);
        }

        /**
         * Returns average syllables per word for text.
         * @param   strText      Text to be measured
         */
        public function average_syllables_per_word($strText) {
            $strText = $this->clean_text($strText);
            $intSyllableCount = 0;
            $intWordCount = $this->word_count($strText);
            $arrWords = explode(' ', $strText);
            for ($i = 0; $i < $intWordCount; $i++) {
                $intSyllableCount += $this->syllable_count($arrWords[$i]);
            }
            return ($intSyllableCount / $intWordCount);
        }

        /**
         * Returns the number of words with more than three syllables
         * @param   strText                  Text to be measured
         * @param   blnCountProperNouns      Boolean - should proper nouns be included in words count
         */
        public function words_with_three_syllables($strText, $blnCountProperNouns = true) {
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
         * @param   strText      Text to be measured
         * @param   blnCountProperNouns      Boolean - should proper nouns be included in words count
         */
        public function percentage_words_with_three_syllables($strText, $blnCountProperNouns = true) {
            $strText = $this->clean_text($strText);
            $intWordCount = $this->word_count($strText);
            $intLongWordCount = $this->words_with_three_syllables($strText, $blnCountProperNouns);
            $intPercentage = (($intLongWordCount / $intWordCount) * 100);
            return ($intPercentage);
        }

        /**
         * Returns the number of syllables in the word.
         * Based in part on Greg Fast's Perl module Lingua::EN::Syllables
         * @param   strWord      Word to be measured
         */
        public function syllable_count($strWord) {

            $intSyllableCount = 0;
            $strWord = $this->lower_case($strWord);

            // Specific common exceptions that don't follow the rule set below are handled individually
            // Array of problem words (with word as key, syllable count as value)
            $arrProblemWords = Array(
                 'simile' => 3
                ,'forever' => 3
                ,'shoreline' => 2
            );
            if (isset($arrProblemWords[$strWord])) {
            	$intSyllableCount = $arrProblemWords[$strWord];
            }
            if ($intSyllableCount > 0) { 
                return $intSyllableCount;
            }

            // These syllables would be counted as two but should be one
            $arrSubSyllables = Array(
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
                ,'^[dr]e[aeiou][^aeiou]+$' // Sorts out deal, deign etc
                ,'[aeiouy]rse$' // Purse, hearse
            );

            // These syllables would be counted as one but should be two
            $arrAddSyllables = Array(
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
            $arrPrefixSuffix = Array(
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
                $intSyllableCount -= preg_match('~' . $strSyllable . '~', $strWord);
            }
            foreach ($arrAddSyllables as $strSyllable) {
                $intSyllableCount += preg_match('~' . $strSyllable . '~', $strWord);
            }
            $intSyllableCount = ($intSyllableCount == 0) ? 1 : $intSyllableCount;
            return $intSyllableCount;
        }

    }

?>