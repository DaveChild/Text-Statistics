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
        $this->assertEquals(3.1, DaveChild\TextStatistics\Maths::normaliseScore(3.141592654, 1, 10, 1));
        $this->assertEquals(10, DaveChild\TextStatistics\Maths::normaliseScore(13.141592654, 1, 10, 1));
        $this->assertEquals(1, DaveChild\TextStatistics\Maths::normaliseScore(-3.141592654, 1, 10, 1));
        $this->assertEquals(3, DaveChild\TextStatistics\Maths::normaliseScore(3, 1, 10, 1));
    }

    /* Test Normalisation
    -------------------- */
    public function testCalc()
    {
        $this->assertEquals(15, DaveChild\TextStatistics\Maths::bcCalc(10, '+', 5, true, 1));
        $this->assertEquals(15, DaveChild\TextStatistics\Maths::bcCalc(10, 'add', 5, true, 1));
        $this->assertEquals(15, DaveChild\TextStatistics\Maths::bcCalc(10, 'addition', 5, true, 1));
        $this->assertEquals(15.6, DaveChild\TextStatistics\Maths::bcCalc(10, '+', 5.55, true, 1));
        $this->assertEquals(15.6, DaveChild\TextStatistics\Maths::bcCalc(10, 'add', 5.55, true, 1));
        $this->assertEquals(15.6, DaveChild\TextStatistics\Maths::bcCalc(10, 'addition', 5.55, true, 1));
        $this->assertEquals(5, DaveChild\TextStatistics\Maths::bcCalc(10, '-', 5, true, 1));
        $this->assertEquals(5, DaveChild\TextStatistics\Maths::bcCalc(10, 'sub', 5, true, 1));
        $this->assertEquals(5, DaveChild\TextStatistics\Maths::bcCalc(10, 'subtract', 5, true, 1));
        $this->assertEquals(4.5, DaveChild\TextStatistics\Maths::bcCalc(10, '-', 5.55, true, 1));
        $this->assertEquals(4.5, DaveChild\TextStatistics\Maths::bcCalc(10, 'sub', 5.55, true, 1));
        $this->assertEquals(4.5, DaveChild\TextStatistics\Maths::bcCalc(10, 'subtract', 5.55, true, 1));
        $this->assertEquals(4.4, DaveChild\TextStatistics\Maths::bcCalc(10, '-', 5.56, true, 1));
        $this->assertEquals(4.4, DaveChild\TextStatistics\Maths::bcCalc(10, 'sub', 5.56, true, 1));
        $this->assertEquals(4.4, DaveChild\TextStatistics\Maths::bcCalc(10, 'subtract', 5.56, true, 1));
        $this->assertEquals(50, DaveChild\TextStatistics\Maths::bcCalc(10, '*', 5, true, 1));
        $this->assertEquals(50, DaveChild\TextStatistics\Maths::bcCalc(10, 'mul', 5, true, 1));
        $this->assertEquals(50, DaveChild\TextStatistics\Maths::bcCalc(10, 'multiply', 5, true, 1));
        $this->assertEquals(55.6, DaveChild\TextStatistics\Maths::bcCalc(10, '*', 5.555, true, 1));
        $this->assertEquals(55.6, DaveChild\TextStatistics\Maths::bcCalc(10, 'mul', 5.555, true, 1));
        $this->assertEquals(55.6, DaveChild\TextStatistics\Maths::bcCalc(10, 'multiply', 5.555, true, 1));
        $this->assertEquals(2, DaveChild\TextStatistics\Maths::bcCalc(10, '/', 5, true, 1));
        $this->assertEquals(2, DaveChild\TextStatistics\Maths::bcCalc(10, 'div', 5, true, 1));
        $this->assertEquals(2, DaveChild\TextStatistics\Maths::bcCalc(10, 'divide', 5, true, 1));
        $this->assertEquals(1.8, DaveChild\TextStatistics\Maths::bcCalc(10, '/', 5.5, true, 1));
        $this->assertEquals(1.8, DaveChild\TextStatistics\Maths::bcCalc(10, 'div', 5.5, true, 1));
        $this->assertEquals(1.8, DaveChild\TextStatistics\Maths::bcCalc(10, 'divide', 5.5, true, 1));
        $this->assertEquals(0, DaveChild\TextStatistics\Maths::bcCalc(0, '/', 10, true, 1));
        $this->assertEquals(0, DaveChild\TextStatistics\Maths::bcCalc(0, 'div', 10, true, 1));
        $this->assertEquals(0, DaveChild\TextStatistics\Maths::bcCalc(0, 'divide', 10, true, 1));

        $this->assertEquals(0, DaveChild\TextStatistics\Maths::bcCalc(10, '%', 5, true, 1));
        $this->assertEquals(0, DaveChild\TextStatistics\Maths::bcCalc(10, 'mod', 5, true, 1));
        $this->assertEquals(0, DaveChild\TextStatistics\Maths::bcCalc(10, 'modulus', 5, true, 1));
        $this->assertEquals(3, DaveChild\TextStatistics\Maths::bcCalc(10, '%', 7, true, 1));
        $this->assertEquals(3, DaveChild\TextStatistics\Maths::bcCalc(10, 'mod', 7, true, 1));
        $this->assertEquals(3, DaveChild\TextStatistics\Maths::bcCalc(10, 'modulus', 7, true, 1));
        // Modulus can only be an integer and is rounded before calculation
        $this->assertEquals(0, DaveChild\TextStatistics\Maths::bcCalc(10, '%', 5.55, true, 1));
        $this->assertEquals(0, DaveChild\TextStatistics\Maths::bcCalc(10, 'mod', 5.55, true, 1));
        $this->assertEquals(0, DaveChild\TextStatistics\Maths::bcCalc(10, 'modulus', 5.55, true, 1));
        $this->assertEquals(3, DaveChild\TextStatistics\Maths::bcCalc(10, '%', 7.55, true, 1));
        $this->assertEquals(3, DaveChild\TextStatistics\Maths::bcCalc(10, 'mod', 7.55, true, 1));
        $this->assertEquals(3, DaveChild\TextStatistics\Maths::bcCalc(10, 'modulus', 7.55, true, 1));

        $this->assertEquals(1, DaveChild\TextStatistics\Maths::bcCalc(10, '=', 5, true, 1));
        $this->assertEquals(1, DaveChild\TextStatistics\Maths::bcCalc(10, 'comp', 5, true, 1));
        $this->assertEquals(1, DaveChild\TextStatistics\Maths::bcCalc(10, 'compare', 5, true, 1));
        $this->assertEquals(0, DaveChild\TextStatistics\Maths::bcCalc(10, '=', 10, true, 1));
        $this->assertEquals(0, DaveChild\TextStatistics\Maths::bcCalc(10, 'comp', 10, true, 1));
        $this->assertEquals(0, DaveChild\TextStatistics\Maths::bcCalc(10, 'compare', 10, true, 1));
        $this->assertEquals(-1, DaveChild\TextStatistics\Maths::bcCalc(5, '=', 10, true, 1));
        $this->assertEquals(-1, DaveChild\TextStatistics\Maths::bcCalc(5, 'comp', 10, true, 1));
        $this->assertEquals(-1, DaveChild\TextStatistics\Maths::bcCalc(5, 'compare', 10, true, 1));

        $this->assertEquals(4, DaveChild\TextStatistics\Maths::bcCalc(16, 'sqrt', 5, true, 1));
        $this->assertEquals(3.9, DaveChild\TextStatistics\Maths::bcCalc(15, 'sqrt', 5, true, 1));
    }
}
