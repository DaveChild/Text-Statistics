<?php

namespace DaveChild\TextStatistics;

class Maths
{

    /**
     * @var boolean $blnBcmath Efficiency: Is the BC Math extension loaded?
     */
    protected static $blnBcmath = null;

    /**
     * Normalises score according to min & max allowed. If score larger
     * than max, max is returned. If score less than min, min is returned.
     * Also rounds result to specified precision.
     * Thanks to github.com/lvil.
     * @param   int|float  $score   Initial score
     * @param   int        $min     Minimum score allowed
     * @param   int        $max     Maximum score allowed
     * @return  int|float
     */
    public static function normaliseScore($score, $min, $max, $dps = 1)
    {
        $score = self::bcCalc($score, '+', 0, true, $dps); // Round
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
    public static function bcCalc($number1, $action, $number2, $round = false, $decimals = 0, $precision = 10)
    {
        if (!is_scalar($number1) || !is_scalar($number2)) {
            return false;
        }

        if (is_null(self::$blnBcmath)) {
            self::$blnBcmath = extension_loaded('bcmath');
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
            case 'sqrt':
                $result = (self::$blnBcmath) ? bcsqrt($number1, $precision) /* string */ : sqrt($number1);
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
                    $result = bcmod(bcdiv($number1, $number2, $precision), $precision); // string, or NULL if modulus is 0.
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
