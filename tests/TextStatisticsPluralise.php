<?php

class TextStatisticsPluralise extends PHPUnit_Framework_TestCase
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

    /* Test Pluralisation
    -------------------- */
    public function testPluralisation()
    {
        $this->assertEquals('geese', DaveChild\TextStatistics\Pluralise::getPlural('goose'));
        $this->assertEquals('mice', DaveChild\TextStatistics\Pluralise::getPlural('mouse'));
        $this->assertEquals('houses', DaveChild\TextStatistics\Pluralise::getPlural('house'));
        $this->assertEquals('bananas', DaveChild\TextStatistics\Pluralise::getPlural('banana'));
        $this->assertEquals('quizzes', DaveChild\TextStatistics\Pluralise::getPlural('quiz'));
        $this->assertEquals('geese', DaveChild\TextStatistics\Pluralise::getPlural('geese'));
        $this->assertEquals('mice', DaveChild\TextStatistics\Pluralise::getPlural('mice'));
        $this->assertEquals('houses', DaveChild\TextStatistics\Pluralise::getPlural('houses'));
        $this->assertEquals('bananas', DaveChild\TextStatistics\Pluralise::getPlural('bananas'));
        $this->assertEquals('quizzes', DaveChild\TextStatistics\Pluralise::getPlural('quizzes'));
        $this->assertEquals('buffalo', DaveChild\TextStatistics\Pluralise::getPlural('buffalo'));
        $this->assertEquals('money', DaveChild\TextStatistics\Pluralise::getPlural('money'));
    }

    /* Test Singularisations
    -------------------- */
    public function testSingularisation()
    {
        $this->assertEquals('goose', DaveChild\TextStatistics\Pluralise::getSingular('goose'));
        $this->assertEquals('mouse', DaveChild\TextStatistics\Pluralise::getSingular('mouse'));
        $this->assertEquals('house', DaveChild\TextStatistics\Pluralise::getSingular('house'));
        $this->assertEquals('banana', DaveChild\TextStatistics\Pluralise::getSingular('banana'));
        $this->assertEquals('quiz', DaveChild\TextStatistics\Pluralise::getSingular('quiz'));
        $this->assertEquals('goose', DaveChild\TextStatistics\Pluralise::getSingular('geese'));
        $this->assertEquals('mouse', DaveChild\TextStatistics\Pluralise::getSingular('mice'));
        $this->assertEquals('house', DaveChild\TextStatistics\Pluralise::getSingular('houses'));
        $this->assertEquals('banana', DaveChild\TextStatistics\Pluralise::getSingular('bananas'));
        $this->assertEquals('quiz', DaveChild\TextStatistics\Pluralise::getSingular('quizzes'));
        $this->assertEquals('buffalo', DaveChild\TextStatistics\Pluralise::getPlural('buffalo'));
        $this->assertEquals('money', DaveChild\TextStatistics\Pluralise::getPlural('money'));
    }
}
