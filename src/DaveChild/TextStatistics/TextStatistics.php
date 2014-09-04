<?php

namespace DaveChild\TextStatistics;

/*

    TextStatistics Project
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
    $statistics = new DaveChild\TextStatistics\TextStatistics;
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
     * @var bool $normalise Should the result be normalised?
     */
    public $normalise = true;

    /**
     * @var int $dps How many decimal places should results be given to?
     */
    public $dps = 1;

    /**
     * @var string $strText Holds the last text checked. If no text passed to
     * function, it will use this text instead.
     */
    private static $strText = false;

    /**
     * Constructor.
     *
     * @param  string  $strEncoding Optional character encoding.
     * @return void
     */
    public function __construct($strEncoding = '')
    {
        if ($strEncoding != '') {
            // Encoding is given. Use it!
            $this->strEncoding = $strEncoding;
        }
    }

    /**
     * Set the text to measure the readability of.
     * @param   string|boolean  $strText         Text to be checked
     * @return  string                   Cleaned text
     */
    public function setText($strText)
    {

        // If text passed in, clean it up and store it for subsequent queries
        if ($strText !== false) {
            self::$strText = Text::cleanText($strText);
        }

        return self::$strText;
    }

    /**
     * Set the encoding of the text being measured.
     * @param   string  $strEncoding New encoding
     * @return  boolean
     */
    public function setEncoding($strEncoding)
    {
        $this->strEncoding = $strEncoding;
        return true;
    }

    /**
     * Gives the Flesch-Kincaid Reading Ease of text entered rounded to one digit
     * @param   boolean|string  $strText         Text to be checked
     * @return  int|float
     */
    public function fleschKincaidReadingEase($strText = false)
    {
        $strText = $this->setText($strText);

        $score = Maths::bcCalc(
            Maths::bcCalc(
                206.835,
                '-',
                Maths::bcCalc(
                    1.015,
                    '*',
                    Text::averageWordsPerSentence($strText, $this->strEncoding)
                )
            ),
            '-',
            Maths::bcCalc(
                84.6,
                '*',
                Syllables::averageSyllablesPerWord($strText, $this->strEncoding)
            )
        );

        if ($this->normalise) {
            return Maths::normaliseScore($score, 0, 100, $this->dps);
        } else {
            return Maths::bcCalc($score, '+', 0, true, $this->dps);
        }
    }

    /**
     * Gives the Flesch-Kincaid Grade level of text entered rounded to one digit
     * @param   boolean|string  $strText         Text to be checked
     * @return  int|float
     */
    public function fleschKincaidGradeLevel($strText = false)
    {
        $strText = $this->setText($strText);

        $score = Maths::bcCalc(
            Maths::bcCalc(
                0.39,
                '*',
                Text::averageWordsPerSentence($strText, $this->strEncoding)
            ),
            '+',
            Maths::bcCalc(
                Maths::bcCalc(
                    11.8,
                    '*',
                    Syllables::averageSyllablesPerWord($strText, $this->strEncoding)
                ),
                '-',
                15.59
            )
        );

        if ($this->normalise) {
            return Maths::normaliseScore($score, 0, 12, $this->dps);
        } else {
            return Maths::bcCalc($score, '+', 0, true, $this->dps);
        }
    }

    /**
     * Gives the Gunning-Fog score of text entered rounded to one digit
     * @param   boolean|string  $strText         Text to be checked
     * @return  int|float
     */
    public function gunningFogScore($strText = false)
    {
        $strText = $this->setText($strText);

        $score = Maths::bcCalc(
            Maths::bcCalc(
                Text::averageWordsPerSentence($strText, $this->strEncoding),
                '+',
                Syllables::percentageWordsWithThreeSyllables($strText, false, $this->strEncoding)
            ),
            '*',
            '0.4'
        );

        if ($this->normalise) {
            return Maths::normaliseScore($score, 0, 19, $this->dps);
        } else {
            return Maths::bcCalc($score, '+', 0, true, $this->dps);
        }
    }

    /**
     * Gives the Coleman-Liau Index of text entered rounded to one digit
     * @param   boolean|string  $strText         Text to be checked
     * @return  int|float
     */
    public function colemanLiauIndex($strText = false)
    {
        $strText = $this->setText($strText);

        $score = Maths::bcCalc(
            Maths::bcCalc(
                Maths::bcCalc(
                    5.89,
                    '*',
                    Maths::bcCalc(
                        Text::letterCount($strText, $this->strEncoding),
                        '/',
                        Text::wordCount($strText, $this->strEncoding)
                    )
                ),
                '-',
                Maths::bcCalc(
                    0.3,
                    '*',
                    Maths::bcCalc(
                        Text::sentenceCount($strText, $this->strEncoding),
                        '/',
                        Text::wordCount($strText, $this->strEncoding)
                    )
                )
            ),
            '-',
            15.8
        );

        if ($this->normalise) {
            return Maths::normaliseScore($score, 0, 12, $this->dps);
        } else {
            return Maths::bcCalc($score, '+', 0, true, $this->dps);
        }
    }

    /**
     * Gives the SMOG Index of text entered rounded to one digit
     * @param   boolean|string  $strText         Text to be checked
     * @return  int|float
     */
    public function smogIndex($strText = false)
    {
        $strText = $this->setText($strText);

        $score = Maths::bcCalc(
            1.043,
            '*',
            Maths::bcCalc(
                Maths::bcCalc(
                    Maths::bcCalc(
                        Syllables::wordsWithThreeSyllables($strText, true, $this->strEncoding),
                        '*',
                        Maths::bcCalc(
                            30,
                            '/',
                            Text::sentenceCount($strText, $this->strEncoding)
                        )
                    ),
                    '+',
                    3.1291
                ),
                'sqrt',
                0
            )
        );

        if ($this->normalise) {
            return Maths::normaliseScore($score, 0, 12, $this->dps);
        } else {
            return Maths::bcCalc($score, '+', 0, true, $this->dps);
        }
    }

    /**
     * Gives the Automated Readability Index of text entered rounded to one digit
     * @param   boolean|string  $strText         Text to be checked
     * @return  int|float
     */
    public function automatedReadabilityIndex($strText = false)
    {
        $strText = $this->setText($strText);

        $score = Maths::bcCalc(
            Maths::bcCalc(
                4.71,
                '*',
                Maths::bcCalc(
                    Text::letterCount($strText, $this->strEncoding),
                    '/',
                    Text::wordCount($strText, $this->strEncoding)
                )
            ),
            '+',
            Maths::bcCalc(
                Maths::bcCalc(
                    0.5,
                    '*',
                    Maths::bcCalc(
                        Text::wordCount($strText, $this->strEncoding),
                        '/',
                        Text::sentenceCount($strText, $this->strEncoding)
                    )
                ),
                '-',
                21.43
            )
        );

        if ($this->normalise) {
            return Maths::normaliseScore($score, 0, 12, $this->dps);
        } else {
            return Maths::bcCalc($score, '+', 0, true, $this->dps);
        }
    }

    /**
     * Gives the Dale-Chall readability score of text entered rounded to one digit
     * @param   boolean|string  $strText         Text to be checked
     * @return  int|float
     */
    public function daleChallReadabilityScore($strText = false)
    {
        $strText = $this->setText($strText);

        $score = Maths::bcCalc(
            Maths::bcCalc(
                0.1579,
                '*',
                Maths::bcCalc(
                    100,
                    '*',
                    Maths::bcCalc(
                        $this->daleChallDifficultWordCount($strText),
                        '/',
                        Text::wordCount($strText, $this->strEncoding)
                    )
                )
            ),
            '+',
            Maths::bcCalc(
                0.0496,
                '*',
                Maths::bcCalc(
                    Text::wordCount($strText, $this->strEncoding),
                    '/',
                    Text::sentenceCount($strText, $this->strEncoding)
                )
            )
        );

        if ($this->normalise) {
            return Maths::normaliseScore($score, 0, 10, $this->dps);
        } else {
            return Maths::bcCalc($score, '+', 0, true, $this->dps);
        }
    }

    /**
     * Gives the Spache readability score of text entered rounded to one digit
     * @param   boolean|string  $strText         Text to be checked
     * @return  int|float
     */
    public function spacheReadabilityScore($strText = false)
    {
        $strText = $this->setText($strText);

        $score = Maths::bcCalc(
            Maths::bcCalc(
                Maths::bcCalc(
                    0.121,
                    '*',
                    Maths::bcCalc(
                        Text::wordCount($strText, $this->strEncoding),
                        '/',
                        Text::sentenceCount($strText, $this->strEncoding)
                    )
                ),
                '+',
                Maths::bcCalc(
                    0.082,
                    '*',
                    $this->spacheDifficultWordCount($strText)
                )
            ),
            '+',
            0.659
        );

        if ($this->normalise) {
            return Maths::normaliseScore($score, 0, 5, $this->dps); // Not really suitable for measuring readability above grade 4
        } else {
            return Maths::bcCalc($score, '+', 0, true, $this->dps);
        }
    }

    /**
     * Returns the number of words NOT on the Dale-Chall easy word list
     * @param   boolean|string  $strText                  Text to be measured
     * @return  int
     */
    public function daleChallDifficultWordCount($strText = false)
    {
        $strText = $this->setText($strText);
        $intDifficultWords = 0;
        $arrWords = explode(' ', Text::lowerCase(preg_replace('`[^A-za-z\' ]`', '', $strText), $this->strEncoding));

        // Fetch Dale-Chall Words
        $arrDaleChall = Resource::fetchDaleChallWordList();

        for ($i = 0, $intWordCount = count($arrWords); $i < $intWordCount; $i++) {
            // Single letters are counted as easy
            if (strlen(trim($arrWords[$i])) < 2) {
                continue;
            }
            if ((!in_array(Pluralise::getPlural($arrWords[$i]), $arrDaleChall)) && (!in_array(Pluralise::getSingular($arrWords[$i]), $arrDaleChall))) {
                $intDifficultWords++;
            }
        }

        return $intDifficultWords;
    }

    /**
     * Returns the number of unique words NOT on the Spache easy word list
     * @param   boolean|string  $strText                  Text to be measured
     * @return  int
     */
    public function spacheDifficultWordCount($strText = false)
    {
        $strText = $this->setText($strText);
        $intDifficultWords = 0;
        $arrWords = explode(' ', strtolower(preg_replace('`[^A-za-z\' ]`', '', $strText)));
        // Fetch Spache Words
        $wordsCounted = array();

        // Get the Spache word list
        $arrSpache = Resource::fetchSpacheWordList();

        for ($i = 0, $intWordCount = count($arrWords); $i < $intWordCount; $i++) {
            // Single letters are counted as easy
            if (strlen(trim($arrWords[$i])) < 2) {
                continue;
            }
            $singularWord = Pluralise::getSingular($arrWords[$i]);
            if ((!in_array(Pluralise::getPlural($arrWords[$i]), $arrSpache)) && (!in_array($singularWord, $arrSpache))) {
                if (!in_array($singularWord, $wordsCounted)) {
                    $intDifficultWords++;
                    $wordsCounted[] = $singularWord;
                }
            }
        }

        return $intDifficultWords;
    }

    /**
     * Returns letter count for text.
     * @param   boolean|string  $strText      Text to be measured
     * @return  int
     */
    public function letterCount($strText = false)
    {
        $strText = $this->setText($strText);

        return Text::letterCount($strText, $this->strEncoding);
    }

    /**
     * Returns sentence count for text.
     * @param   boolean|string  $strText      Text to be measured
     * @return  int
     */
    public function sentenceCount($strText = false)
    {
        $strText = $this->setText($strText);

        return Text::sentenceCount($strText, $this->strEncoding);
    }

    /**
     * Returns word count for text.
     * @param   boolean|string  $strText      Text to be measured
     * @return  int
     */
    public function wordCount($strText = false)
    {
        $strText = $this->setText($strText);

        return Text::wordCount($strText, $this->strEncoding);
    }

    /**
     * Returns average words per sentence for text.
     * @param   boolean|string  $strText      Text to be measured
     * @return  int|float
     */
    public function averageWordsPerSentence($strText = false)
    {
        $strText = $this->setText($strText);

        return Text::averageWordsPerSentence($strText, $this->strEncoding);
    }

    /**
     * Returns number of syllables in a word
     * @param   boolean|string  $strText      Text to be measured
     * @return  int
     */
    public function syllableCount($strText = false)
    {
        $strText = $this->setText($strText);

        return Syllables::syllableCount($strText, $this->strEncoding);
    }

    /**
     * Returns total syllable count for text.
     * @param   boolean|string  $strText      Text to be measured
     * @return  int
     */
    public function totalSyllables($strText = false)
    {
        $strText = $this->setText($strText);

        return Syllables::totalSyllables($strText, $this->strEncoding);
    }

    /**
     * Returns average syllables per word for text.
     * @param   boolean|string  $strText      Text to be measured
     * @return  int|float
     */
    public function averageSyllablesPerWord($strText = false)
    {
        $strText = $this->setText($strText);

        return Syllables::averageSyllablesPerWord($strText, $this->strEncoding);
    }

    /**
     * Returns the number of words with more than three syllables
     * @param   boolean|string  $strText                  Text to be measured
     * @param   bool    $blnCountProperNouns      Boolean - should proper nouns be included in words count
     * @return  int
     */
    public function wordsWithThreeSyllables($strText = false, $blnCountProperNouns = true)
    {
        $strText = $this->setText($strText);

        return Syllables::wordsWithThreeSyllables($strText, $blnCountProperNouns, $this->strEncoding);
    }

    /**
     * Returns the percentage of words with more than three syllables
     * @param   boolean|string  $strText      Text to be measured
     * @param   bool    $blnCountProperNouns      Boolean - should proper nouns be included in words count
     * @return  int|float
     */
    public function percentageWordsWithThreeSyllables($strText = false, $blnCountProperNouns = true)
    {
        $strText = $this->setText($strText);

        return Syllables::percentageWordsWithThreeSyllables($strText, $blnCountProperNouns, $this->strEncoding);
    }

    /**
     * We switched to camel-case but we'll leave these aliases in for
     * convenience for anyone switching from the previous version.
     */
    public function flesch_kincaid_reading_ease($strText = false)
    {
        return $this->fleschKincaidReadingEase($strText);
    }

    public function flesch_kincaid_grade_level($strText = false)
    {
        return $this->fleschKincaidGradeLevel($strText);
    }

    public function gunning_fog_score($strText = false)
    {
        return $this->gunningFogScore($strText);
    }

    public function coleman_liau_index($strText = false)
    {
        return $this->colemanLiauIndex($strText);
    }

    public function smog_index($strText = false)
    {
        return $this->smogIndex($strText);
    }

    public function automated_readability_index($strText = false)
    {
        return $this->automatedReadabilityIndex($strText);
    }

    public function dale_chall_readability_score($strText = false)
    {
        return $this->daleChallReadabilityScore($strText);
    }

    public function spache_readability_score($strText = false)
    {
        return $this->spacheReadabilityScore($strText);
    }
}
