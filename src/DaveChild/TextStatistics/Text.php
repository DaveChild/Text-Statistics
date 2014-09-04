<?php

namespace DaveChild\TextStatistics;

class Text
{

    /**
     * @var boolean $blnMbstring Efficiency: Is the MB String extension loaded?
     */
    protected static $blnMbstring = null;

    /**
     * @var array $clean Efficiency: Store strings once processed.
     */
    protected static $clean = array();

    /**
     * Trims, removes line breaks, multiple spaces and generally cleans text
     * before processing.
     * @param   string|boolean  $strText      Text to be transformed
     * @return  string
     */
    public static function cleanText($strText)
    {

        // Check for boolean before processing as string
        if (is_bool($strText)) {
            return '';
        }

        // Check to see if we already processed this text. If we did, don't
        // re-process it.
        $key = sha1($strText);
        if (isset(self::$clean[$key])) {
            return self::$clean[$key];
        }

        $strText = utf8_decode($strText);

        // Curly quotes etc
        $strText = str_replace(
            array(
                "\xe2\x80\x98",
                "\xe2\x80\x99",
                "\xe2\x80\x9c",
                "\xe2\x80\x9d",
                "\xe2\x80\x93",
                "\xe2\x80\x94",
                "\xe2\x80\xa6"
            ),
            array(
                "'",
                "'",
                '"',
                '"',
                '-',
                '--',
                '...'
            ),
            $strText
        );
        $strText = str_replace(
            array(
                chr(145),
                chr(146),
                chr(147),
                chr(148),
                chr(150),
                chr(151),
                chr(133)
            ),
            array(
                "'",
                "'",
                '"',
                '"',
                '-',
                '--',
                '...'
            ),
            $strText
        );

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
        self::$clean[$key] = $strText;
        return $strText;
    }

    /**
     * Converts string to lower case. Tries mb_strtolower and if that fails uses regular strtolower.
     * @param   string  $strText      Text to be transformed
     * @param   string  $strEncoding  Encoding of text
     * @return  string
     */
    public static function lowerCase($strText, $strEncoding = '')
    {

        if (is_null(self::$blnMbstring)) {
            self::$blnMbstring = extension_loaded('mbstring');
        }

        if (!self::$blnMbstring) {
            $strLowerCaseText = strtolower($strText);
        } else {
            if ($strEncoding == '') {
                $strLowerCaseText = mb_strtolower($strText);
            } else {
                $strLowerCaseText = mb_strtolower($strText, $strEncoding);
            }
        }

        return $strLowerCaseText;
    }

    /**
     * Converts string to upper case. Tries mb_strtoupper and if that fails uses regular strtoupper.
     * @param   string  $strText      Text to be transformed
     * @param   string  $strEncoding  Encoding of text
     * @return  string
     */
    public static function upperCase($strText, $strEncoding = '')
    {

        if (is_null(self::$blnMbstring)) {
            self::$blnMbstring = extension_loaded('mbstring');
        }

        if (!self::$blnMbstring) {
            $strUpperCaseText = strtoupper($strText);
        } else {
            if ($strEncoding == '') {
                $strUpperCaseText = mb_strtoupper($strText);
            } else {
                $strUpperCaseText = mb_strtoupper($strText, $strEncoding);
            }
        }

        return $strUpperCaseText;
    }

    /**
     * Gets portion of string. Tries mb_substr and if that fails uses regular substr.
     * @param   string  $strText      Text to be cut up
     * @param   int     $intStart     Start character
     * @param   int     $intLength    Length
     * @param   string  $strEncoding  Encoding of text
     * @return  string
     */
    public static function substring($strText, $intStart, $intLength, $strEncoding = '')
    {

        if (is_null(self::$blnMbstring)) {
            self::$blnMbstring = extension_loaded('mbstring');
        }

        if (!self::$blnMbstring) {
            $strSubstring = substr($strText, $intStart, $intLength);
        } else {
            if ($strEncoding == '') {
                $strSubstring = mb_substr($strText, $intStart, $intLength);
            } else {
                $strSubstring = mb_substr($strText, $intStart, $intLength, $strEncoding);
            }
        }

        return $strSubstring;
    }

    /**
     * Gives string length. Tries mb_strlen and if that fails uses regular strlen.
     * @param   string  $strText      Text to be measured
     * @param   string  $strEncoding  Encoding of text
     * @return  int
     */
    public static function textLength($strText, $strEncoding = '')
    {

        if (is_null(self::$blnMbstring)) {
            self::$blnMbstring = extension_loaded('mbstring');
        }

        if (!self::$blnMbstring) {
            $intTextLength = strlen($strText);
        } else {
            if ($strEncoding == '') {
                $intTextLength = mb_strlen($strText);
            } else {
                $intTextLength = mb_strlen($strText, $strEncoding);
            }
        }

        return $intTextLength;
    }

    /**
     * Alias for textLength, as "letterCount", "wordCount" etc also used
     * @param   string  $strText      Text to be measured
     * @param   string  $strEncoding  Encoding of text
     * @return  int
     */
    public static function characterCount($strText, $strEncoding = '')
    {
        return self::textLength($strText, $strEncoding);
    }

    /**
     * Gives letter count (ignores all non-letters). Tries mb_strlen and if
     * that fails uses regular strlen.
     * @param   string  $strText      Text to be measured
     * @param   string  $strEncoding  Encoding of text
     * @return  int
     */
    public static function letterCount($strText, $strEncoding = '')
    {
        if (strlen(trim($strText)) == 0) {
            return 0;
        }

        if (is_null(self::$blnMbstring)) {
            self::$blnMbstring = extension_loaded('mbstring');
        }

        $strText = self::cleanText($strText); // To clear out newlines etc
        $intTextLength = 0;
        $strText = preg_replace('`[^A-Za-z]+`', '', $strText);
        try {

            if (!self::$blnMbstring) {
                throw new Exception('The extension mbstring is not loaded.');
            }

            if ($strEncoding == '') {
                $intTextLength = mb_strlen($strText);
            } else {
                $intTextLength = mb_strlen($strText, $strEncoding);
            }
        } catch (\Exception $e) {
            $intTextLength = strlen($strText);
        }

        return $intTextLength;
    }

    /**
     * Returns word count for text.
     * @param   string  $strText      Text to be measured
     * @param   string  $strEncoding  Encoding of text
     * @return  int
     */
    public static function wordCount($strText, $strEncoding = '')
    {
        if (strlen(trim($strText)) == 0) {
            return 0;
        }

        // Will be tripped by em dashes with spaces either side, among other similar characters
        $intWords = 1 + self::textLength(preg_replace('`[^ ]`', '', $strText), $strEncoding); // Space count + 1 is word count

        return $intWords;
    }

    /**
     * Returns sentence count for text.
     * @param   string  $strText      Text to be measured
     * @param   string  $strEncoding  Encoding of text
     * @return  int
     */
    public static function sentenceCount($strText, $strEncoding = '')
    {
        if (strlen(trim($strText)) == 0) {
            return 0;
        }

        // Will be tripped up by "Mr." or "U.K.". Not a major concern at this point.
        $intSentences = max(1, self::textLength(preg_replace('`[^\.!?]`', '', $strText), $strEncoding));

        return $intSentences;
    }

    /**
     * Returns average words per sentence for text.
     * @param   string  $strText      Text to be measured
     * @param   string  $strEncoding  Encoding of text
     * @return  int|float
     */
    public static function averageWordsPerSentence($strText, $strEncoding = '')
    {
        $intSentenceCount = self::sentenceCount($strText, $strEncoding);
        $intWordCount = self::wordCount($strText, $strEncoding);

        $averageWords = (Maths::bcCalc($intWordCount, '/', $intSentenceCount));
        return $averageWords;
    }
}
