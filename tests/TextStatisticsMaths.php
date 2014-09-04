<?php

class TextStatisticsMaths extends PHPUnit_Framework_TestCase
{

    /*

        This file contains the more basic tests - short sentences, word counts,
        sentence counts, and so on. Longer texts are split into their own test
        files for convenience.

    */

    protected $TextStatistics = null;

    public function setUp()
    {
        $this->TextStatistics = new DaveChild\TextStatistics\TextStatistics();
        $this->TextStatistics->normalise = false;
    }

    public function tearDown()
    {
        unset($this->objTextStatistics);
    }

    /* Test Normalisation
    -------------------- */
    public function testNormalisation()
    {
        // Maths::normaliseScore($score, $min, $max, $dps = 1)
        $this->assertSame(3.1, DaveChild\TextStatistics\Maths::normaliseScore(3.141592654, 1, 10, 1));
        $this->assertSame(10.0, DaveChild\TextStatistics\Maths::normaliseScore(13.141592654, 1, 10, 1));
        $this->assertSame(1.0, DaveChild\TextStatistics\Maths::normaliseScore(-3.141592654, 1, 10, 1));
        $this->assertSame(3.0, DaveChild\TextStatistics\Maths::normaliseScore(3, 1, 10, 1));
        $this->assertSame(3, DaveChild\TextStatistics\Maths::normaliseScore(3.141592654, 1, 10, 0));
        $this->assertSame(10, DaveChild\TextStatistics\Maths::normaliseScore(13.141592654, 1, 10, 0));
        $this->assertSame(1, DaveChild\TextStatistics\Maths::normaliseScore(-3.141592654, 1, 10, 0));
        $this->assertSame(3, DaveChild\TextStatistics\Maths::normaliseScore(3, 1, 10, 0));
    }

    /* Test Normalisation
    -------------------- */
    public function testCalc()
    {
        $this->assertSame(15.0, DaveChild\TextStatistics\Maths::bcCalc(10, '+', 5, true, 1));
        $this->assertSame(15.0, DaveChild\TextStatistics\Maths::bcCalc(10, 'add', 5, true, 1));
        $this->assertSame(15.0, DaveChild\TextStatistics\Maths::bcCalc(10, 'addition', 5, true, 1));
        $this->assertSame(15.6, DaveChild\TextStatistics\Maths::bcCalc(10, '+', 5.55, true, 1));
        $this->assertSame(15.6, DaveChild\TextStatistics\Maths::bcCalc(10, 'add', 5.55, true, 1));
        $this->assertSame(15.6, DaveChild\TextStatistics\Maths::bcCalc(10, 'addition', 5.55, true, 1));
        $this->assertSame(5.0, DaveChild\TextStatistics\Maths::bcCalc(10, '-', 5, true, 1));
        $this->assertSame(5.0, DaveChild\TextStatistics\Maths::bcCalc(10, 'sub', 5, true, 1));
        $this->assertSame(5.0, DaveChild\TextStatistics\Maths::bcCalc(10, 'subtract', 5, true, 1));
        $this->assertSame(4.5, DaveChild\TextStatistics\Maths::bcCalc(10, '-', 5.55, true, 1));
        $this->assertSame(4.5, DaveChild\TextStatistics\Maths::bcCalc(10, 'sub', 5.55, true, 1));
        $this->assertSame(4.5, DaveChild\TextStatistics\Maths::bcCalc(10, 'subtract', 5.55, true, 1));
        $this->assertSame(4.4, DaveChild\TextStatistics\Maths::bcCalc(10, '-', 5.56, true, 1));
        $this->assertSame(4.4, DaveChild\TextStatistics\Maths::bcCalc(10, 'sub', 5.56, true, 1));
        $this->assertSame(4.4, DaveChild\TextStatistics\Maths::bcCalc(10, 'subtract', 5.56, true, 1));
        $this->assertSame(50.0, DaveChild\TextStatistics\Maths::bcCalc(10, '*', 5, true, 1));
        $this->assertSame(50.0, DaveChild\TextStatistics\Maths::bcCalc(10, 'mul', 5, true, 1));
        $this->assertSame(50.0, DaveChild\TextStatistics\Maths::bcCalc(10, 'multiply', 5, true, 1));
        $this->assertSame(55.6, DaveChild\TextStatistics\Maths::bcCalc(10, '*', 5.555, true, 1));
        $this->assertSame(55.6, DaveChild\TextStatistics\Maths::bcCalc(10, 'mul', 5.555, true, 1));
        $this->assertSame(55.6, DaveChild\TextStatistics\Maths::bcCalc(10, 'multiply', 5.555, true, 1));
        $this->assertSame(2.0, DaveChild\TextStatistics\Maths::bcCalc(10, '/', 5, true, 1));
        $this->assertSame(2.0, DaveChild\TextStatistics\Maths::bcCalc(10, 'div', 5, true, 1));
        $this->assertSame(2.0, DaveChild\TextStatistics\Maths::bcCalc(10, 'divide', 5, true, 1));
        $this->assertSame(1.8, DaveChild\TextStatistics\Maths::bcCalc(10, '/', 5.5, true, 1));
        $this->assertSame(1.8, DaveChild\TextStatistics\Maths::bcCalc(10, 'div', 5.5, true, 1));
        $this->assertSame(1.8, DaveChild\TextStatistics\Maths::bcCalc(10, 'divide', 5.5, true, 1));
        $this->assertSame(0.0, DaveChild\TextStatistics\Maths::bcCalc(0, '/', 10, true, 1));
        $this->assertSame(0.0, DaveChild\TextStatistics\Maths::bcCalc(0, 'div', 10, true, 1));
        $this->assertSame(0.0, DaveChild\TextStatistics\Maths::bcCalc(0, 'divide', 10, true, 1));

        $this->assertSame(0.0, DaveChild\TextStatistics\Maths::bcCalc(10, '%', 5, true, 1));
        $this->assertSame(0.0, DaveChild\TextStatistics\Maths::bcCalc(10, 'mod', 5, true, 1));
        $this->assertSame(0.0, DaveChild\TextStatistics\Maths::bcCalc(10, 'modulus', 5, true, 1));
        $this->assertSame(3.0, DaveChild\TextStatistics\Maths::bcCalc(10, '%', 7, true, 1));
        $this->assertSame(3.0, DaveChild\TextStatistics\Maths::bcCalc(10, 'mod', 7, true, 1));
        $this->assertSame(3.0, DaveChild\TextStatistics\Maths::bcCalc(10, 'modulus', 7, true, 1));
        // Modulus can only be an integer and is rounded before calculation
        $this->assertSame(0.0, DaveChild\TextStatistics\Maths::bcCalc(10, '%', 5.55, true, 1));
        $this->assertSame(0.0, DaveChild\TextStatistics\Maths::bcCalc(10, 'mod', 5.55, true, 1));
        $this->assertSame(0.0, DaveChild\TextStatistics\Maths::bcCalc(10, 'modulus', 5.55, true, 1));
        $this->assertSame(3.0, DaveChild\TextStatistics\Maths::bcCalc(10, '%', 7.55, true, 1));
        $this->assertSame(3.0, DaveChild\TextStatistics\Maths::bcCalc(10, 'mod', 7.55, true, 1));
        $this->assertSame(3.0, DaveChild\TextStatistics\Maths::bcCalc(10, 'modulus', 7.55, true, 1));

        $this->assertSame(1, DaveChild\TextStatistics\Maths::bcCalc(10, '=', 5, true, 1));
        $this->assertSame(1, DaveChild\TextStatistics\Maths::bcCalc(10, 'comp', 5, true, 1));
        $this->assertSame(1, DaveChild\TextStatistics\Maths::bcCalc(10, 'compare', 5, true, 1));
        $this->assertSame(0, DaveChild\TextStatistics\Maths::bcCalc(10, '=', 10, true, 1));
        $this->assertSame(0, DaveChild\TextStatistics\Maths::bcCalc(10, 'comp', 10, true, 1));
        $this->assertSame(0, DaveChild\TextStatistics\Maths::bcCalc(10, 'compare', 10, true, 1));
        $this->assertSame(-1, DaveChild\TextStatistics\Maths::bcCalc(5, '=', 10, true, 1));
        $this->assertSame(-1, DaveChild\TextStatistics\Maths::bcCalc(5, 'comp', 10, true, 1));
        $this->assertSame(-1, DaveChild\TextStatistics\Maths::bcCalc(5, 'compare', 10, true, 1));

        $this->assertSame(4.0, DaveChild\TextStatistics\Maths::bcCalc(16, 'sqrt', 5, true, 1));
        $this->assertSame(3.9, DaveChild\TextStatistics\Maths::bcCalc(15, 'sqrt', 5, true, 1));

        $this->assertSame(15, DaveChild\TextStatistics\Maths::bcCalc(10, '+', 5));
        $this->assertSame(15, DaveChild\TextStatistics\Maths::bcCalc(10, 'add', 5));
        $this->assertSame(15, DaveChild\TextStatistics\Maths::bcCalc(10, 'addition', 5));
        $this->assertSame(15.55, DaveChild\TextStatistics\Maths::bcCalc(10, '+', 5.55));
        $this->assertSame(15.55, DaveChild\TextStatistics\Maths::bcCalc(10, 'add', 5.55));
        $this->assertSame(15.55, DaveChild\TextStatistics\Maths::bcCalc(10, 'addition', 5.55));
        $this->assertSame(5, DaveChild\TextStatistics\Maths::bcCalc(10, '-', 5));
        $this->assertSame(5, DaveChild\TextStatistics\Maths::bcCalc(10, 'sub', 5));
        $this->assertSame(5, DaveChild\TextStatistics\Maths::bcCalc(10, 'subtract', 5));
        $this->assertSame(4.45, DaveChild\TextStatistics\Maths::bcCalc(10, '-', 5.55));
        $this->assertSame(4.45, DaveChild\TextStatistics\Maths::bcCalc(10, 'sub', 5.55));
        $this->assertSame(4.45, DaveChild\TextStatistics\Maths::bcCalc(10, 'subtract', 5.55));
        $this->assertSame(4.44, DaveChild\TextStatistics\Maths::bcCalc(10, '-', 5.56));
        $this->assertSame(4.44, DaveChild\TextStatistics\Maths::bcCalc(10, 'sub', 5.56));
        $this->assertSame(4.44, DaveChild\TextStatistics\Maths::bcCalc(10, 'subtract', 5.56));
        $this->assertSame(50, DaveChild\TextStatistics\Maths::bcCalc(10, '*', 5));
        $this->assertSame(50, DaveChild\TextStatistics\Maths::bcCalc(10, 'mul', 5));
        $this->assertSame(50, DaveChild\TextStatistics\Maths::bcCalc(10, 'multiply', 5));
        $this->assertSame(55.55, DaveChild\TextStatistics\Maths::bcCalc(10, '*', 5.555));
        $this->assertSame(55.55, DaveChild\TextStatistics\Maths::bcCalc(10, 'mul', 5.555));
        $this->assertSame(55.55, DaveChild\TextStatistics\Maths::bcCalc(10, 'multiply', 5.555));
        $this->assertSame(2, DaveChild\TextStatistics\Maths::bcCalc(10, '/', 5));
        $this->assertSame(2, DaveChild\TextStatistics\Maths::bcCalc(10, 'div', 5));
        $this->assertSame(2, DaveChild\TextStatistics\Maths::bcCalc(10, 'divide', 5));
        $this->assertSame(1.81818, DaveChild\TextStatistics\Maths::bcCalc(10, '/', 5.5, true, 5));
        $this->assertSame(1.81818, DaveChild\TextStatistics\Maths::bcCalc(10, 'div', 5.5, true, 5));
        $this->assertSame(1.81818, DaveChild\TextStatistics\Maths::bcCalc(10, 'divide', 5.5, true, 5));
        $this->assertSame(0, DaveChild\TextStatistics\Maths::bcCalc(0, '/', 10));
        $this->assertSame(0, DaveChild\TextStatistics\Maths::bcCalc(0, 'div', 10));
        $this->assertSame(0, DaveChild\TextStatistics\Maths::bcCalc(0, 'divide', 10));

        $this->assertSame(0, DaveChild\TextStatistics\Maths::bcCalc(10, '%', 5));
        $this->assertSame(0, DaveChild\TextStatistics\Maths::bcCalc(10, 'mod', 5));
        $this->assertSame(0, DaveChild\TextStatistics\Maths::bcCalc(10, 'modulus', 5));
        $this->assertSame(3, DaveChild\TextStatistics\Maths::bcCalc(10, '%', 7));
        $this->assertSame(3, DaveChild\TextStatistics\Maths::bcCalc(10, 'mod', 7));
        $this->assertSame(3, DaveChild\TextStatistics\Maths::bcCalc(10, 'modulus', 7));
        // Modulus can only be an integer and is rounded before calculation
        $this->assertSame(0, DaveChild\TextStatistics\Maths::bcCalc(10, '%', 5.55));
        $this->assertSame(0, DaveChild\TextStatistics\Maths::bcCalc(10, 'mod', 5.55));
        $this->assertSame(0, DaveChild\TextStatistics\Maths::bcCalc(10, 'modulus', 5.55));
        $this->assertSame(3, DaveChild\TextStatistics\Maths::bcCalc(10, '%', 7.55));
        $this->assertSame(3, DaveChild\TextStatistics\Maths::bcCalc(10, 'mod', 7.55));
        $this->assertSame(3, DaveChild\TextStatistics\Maths::bcCalc(10, 'modulus', 7.55));

        $this->assertSame(1, DaveChild\TextStatistics\Maths::bcCalc(10, '=', 5));
        $this->assertSame(1, DaveChild\TextStatistics\Maths::bcCalc(10, 'comp', 5));
        $this->assertSame(1, DaveChild\TextStatistics\Maths::bcCalc(10, 'compare', 5));
        $this->assertSame(0, DaveChild\TextStatistics\Maths::bcCalc(10, '=', 10));
        $this->assertSame(0, DaveChild\TextStatistics\Maths::bcCalc(10, 'comp', 10));
        $this->assertSame(0, DaveChild\TextStatistics\Maths::bcCalc(10, 'compare', 10));
        $this->assertSame(-1, DaveChild\TextStatistics\Maths::bcCalc(5, '=', 10));
        $this->assertSame(-1, DaveChild\TextStatistics\Maths::bcCalc(5, 'comp', 10));
        $this->assertSame(-1, DaveChild\TextStatistics\Maths::bcCalc(5, 'compare', 10));

        $this->assertSame(4, DaveChild\TextStatistics\Maths::bcCalc(16, 'sqrt', 5));
        $this->assertSame(3.87298, DaveChild\TextStatistics\Maths::bcCalc(15, 'sqrt', 5, true, 5));

        // Malformed data
        $this->assertSame(false, DaveChild\TextStatistics\Maths::bcCalc(array('banana'), '+', 2, true, 1));
        $this->assertSame(false, DaveChild\TextStatistics\Maths::bcCalc(2, '+', array('banana'), true, 1));
        $this->assertSame(0.0, DaveChild\TextStatistics\Maths::bcCalc('two', '+', 'three', true, 1));
        $this->assertSame(0.0, DaveChild\TextStatistics\Maths::bcCalc('two', '/', 'three', true, 1));
        $this->assertSame(false, DaveChild\TextStatistics\Maths::bcCalc(array('banana'), '+', 2));
        $this->assertSame(false, DaveChild\TextStatistics\Maths::bcCalc(2, '+', array('banana')));
        $this->assertSame(0, DaveChild\TextStatistics\Maths::bcCalc('two', '+', 'three'));
        $this->assertSame(0, DaveChild\TextStatistics\Maths::bcCalc('two', '/', 'three'));
    }
}
