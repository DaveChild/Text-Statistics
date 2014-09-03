<?php

class TextStatisticsMelvilleMobyDick extends PHPUnit_Framework_TestCase
{

    /*

        Text
        --------------------------------------------------------
        Moby Dick by Herman Melville

        Call me Ishmael. Some years ago - never mind how long precisely - having little or no money in my purse, and nothing particular to interest me on shore, I thought I would sail about a little and see the watery part of the world. It is a way I have of driving off the spleen, and regulating the circulation. Whenever I find myself growing grim about the mouth; whenever it is a damp, drizzly November in my soul; whenever I find myself involuntarily pausing before coffin warehouses, and bringing up the rear of every funeral I meet; and especially whenever my hypos get such an upper hand of me, that it requires a strong moral principle to prevent me from deliberately stepping into the street, and methodically knocking people's hats off - then, I account it high time to get to sea as soon as I can. This is my substitute for pistol and ball. With a philosophical flourish Cato throws himself upon his sword; I quietly take to the ship. There is nothing surprising in this. If they but knew it, almost all men in their degree, some time or other, cherish very nearly the same feelings towards the ocean with me.

        Data
        --------------------------------------------------------
        Letter Count:                                        884
        Word Count:                                          201
        3+ syllables:                                         23
        Syllable Count:                                      304
        Sentence Count:                                        8
        Note: 1 of the 3+ syllable words is a proper noun and
        will be ignored by the Gunning-Fog Score.

        Manually Calculated Scores
        --------------------------------------------------------
        Flesch-Kincaid Reading Ease
        (206.835 - (1.015 * (word_count / sentence_count)) - (84.6 * (syllableCount / word_count))) = 53.380886194029850746268656716418

        Flesch-Kincaid Grade Level
        ((0.39 * (word_count / sentence_count)) + (11.8 * (syllableCount / word_count)) - 15.59) = 12.055516169154228855721393034826

        Gunning-Fog Score
        (((word_count / sentence_count) + (100 * (long_word_count / word_count ))) * 0.4) = 14.428109452736318407960199004975

        Coleman-Liau Index
        ((5.89 * (letter_count / word_count)) - (0.3 * (sentence_count / word_count)) - 15.8) = 10.092338308457711442786069651741

        SMOG Index
        (1.043 * sqrt((long_word_count * (30 / sentence_count)) + 3.1291)) = 9.8605762790974848783982768629462

        Automated Readability Index
        ((4.71 * (letter_count / word_count)) + (0.5 * (word_count / sentence_count)) - 21.43) = 11.847126865671641791044776119403

    */

    protected $TextStatistics = null;
    protected $strText = "Call me Ishmael. Some years ago - never mind how long precisely - having little or no money in my purse, and nothing particular to interest me on shore, I thought I would sail about a little and see the watery part of the world. It is a way I have of driving off the spleen, and regulating the circulation. Whenever I find myself growing grim about the mouth; whenever it is a damp, drizzly November in my soul; whenever I find myself involuntarily pausing before coffin warehouses, and bringing up the rear of every funeral I meet; and especially whenever my hypos get such an upper hand of me, that it requires a strong moral principle to prevent me from deliberately stepping into the street, and methodically knocking people's hats off - then, I account it high time to get to sea as soon as I can. This is my substitute for pistol and ball. With a philosophical flourish Cato throws himself upon his sword; I quietly take to the ship. There is nothing surprising in this. If they but knew it, almost all men in their degree, some time or other, cherish very nearly the same feelings towards the ocean with me.";

    public function setUp()
    {
        $this->TextStatistics = new DaveChild\TextStatistics\TextStatistics();
        $this->TextStatistics->normalise = false;
    }

    public function tearDown()
    {
        unset($this->objTextStatistics);
    }

    /* Test Syllables
    -------------------- */
    public function testMobyDickSyllables()
    { // The Words from Moby Dick, in order
        $this->assertEquals(1, $this->TextStatistics->syllableCount('Call'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('me'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('Ishmael'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('Some'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('years'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('ago'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('never'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('mind'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('how'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('long'));
        $this->assertEquals(3, $this->TextStatistics->syllableCount('precisely'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('having'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('little'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('or'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('no'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('money'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('in'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('my'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('purse'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('and'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('nothing'));
        $this->assertEquals(4, $this->TextStatistics->syllableCount('particular'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('to'));
        $this->assertEquals(3, $this->TextStatistics->syllableCount('interest'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('me'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('on'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('shore'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('I'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('thought'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('I'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('would'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('sail'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('about'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('a'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('little'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('and'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('see'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('the'));
        $this->assertEquals(3, $this->TextStatistics->syllableCount('watery'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('part'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('of'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('the'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('world'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('It'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('is'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('a'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('way'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('I'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('have'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('of'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('driving'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('off'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('the'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('spleen'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('and'));
        $this->assertEquals(4, $this->TextStatistics->syllableCount('regulating'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('the'));
        $this->assertEquals(4, $this->TextStatistics->syllableCount('circulation'));
        $this->assertEquals(3, $this->TextStatistics->syllableCount('Whenever'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('I'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('find'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('myself'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('growing'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('grim'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('about'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('the'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('mouth'));
        $this->assertEquals(3, $this->TextStatistics->syllableCount('whenever'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('it'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('is'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('a'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('damp'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('drizzly'));
        $this->assertEquals(3, $this->TextStatistics->syllableCount('November'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('in'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('my'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('soul'));
        $this->assertEquals(3, $this->TextStatistics->syllableCount('whenever'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('I'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('find'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('myself'));
        $this->assertEquals(6, $this->TextStatistics->syllableCount('involuntarily'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('pausing'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('before'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('coffin'));
        $this->assertEquals(3, $this->TextStatistics->syllableCount('warehouses'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('and'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('bringing'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('up'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('the'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('rear'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('of'));
        $this->assertEquals(3, $this->TextStatistics->syllableCount('every'));
        $this->assertEquals(3, $this->TextStatistics->syllableCount('funeral'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('I'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('meet'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('and'));
        $this->assertEquals(4, $this->TextStatistics->syllableCount('especially'));
        $this->assertEquals(3, $this->TextStatistics->syllableCount('whenever'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('my'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('hypos'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('get'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('such'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('an'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('upper'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('hand'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('of'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('me'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('that'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('it'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('requires'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('a'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('strong'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('moral'));
        $this->assertEquals(3, $this->TextStatistics->syllableCount('principle'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('to'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('prevent'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('me'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('from'));
        $this->assertEquals(5, $this->TextStatistics->syllableCount('deliberately'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('stepping'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('into'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('the'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('street'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('and'));
        $this->assertEquals(5, $this->TextStatistics->syllableCount('methodically'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('knocking'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('people\'s'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('hats'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('off'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('then'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('I'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('account'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('it'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('high'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('time'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('to'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('get'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('to'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('sea'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('as'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('soon'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('as'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('I'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('can'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('This'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('is'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('my'));
        $this->assertEquals(3, $this->TextStatistics->syllableCount('substitute'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('for'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('pistol'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('and'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('ball'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('With'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('a'));
        $this->assertEquals(5, $this->TextStatistics->syllableCount('philosophical'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('flourish'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('Cato'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('throws'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('himself'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('upon'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('his'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('sword'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('I'));
        $this->assertEquals(3, $this->TextStatistics->syllableCount('quietly'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('take'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('to'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('the'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('ship'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('There'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('is'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('nothing'));
        $this->assertEquals(3, $this->TextStatistics->syllableCount('surprising'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('in'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('this'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('If'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('they'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('but'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('knew'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('it'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('almost'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('all'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('men'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('in'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('their'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('degree'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('some'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('time'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('or'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('other'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('cherish'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('very'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('nearly'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('the'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('same'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('feelings'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('towards'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('the'));
        $this->assertEquals(2, $this->TextStatistics->syllableCount('ocean'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('with'));
        $this->assertEquals(1, $this->TextStatistics->syllableCount('me'));
    }

    /* Test Word Count
    -------------------- */
    public function testWordCount()
    {
        $this->assertEquals(201, $this->TextStatistics->wordCount($this->strText));
    }

    /* Test Long Word Count
    -------------------- */
    public function testLongWordCount()
    {
        $this->assertEquals(23, $this->TextStatistics->wordsWithThreeSyllables($this->strText, true)); // Include proper nouns
        $this->assertEquals(22, $this->TextStatistics->wordsWithThreeSyllables($this->strText, false)); // Don't include proper nouns
    }

    /* Test Sentences
    -------------------- */
    public function testSentenceCount()
    {
        $this->assertEquals(8, $this->TextStatistics->sentenceCount($this->strText));
    }

    /* Test Letter Count
    -------------------- */
    public function testTextLengthCheck()
    {
        $this->assertEquals(884, $this->TextStatistics->letterCount($this->strText));
    }

    /* Test Flesch Kincaid Reading Ease
    -------------------- */
    public function testFleschKincaidReadingEase()
    {
        $this->assertEquals(53.4, $this->TextStatistics->flesch_kincaid_reading_ease($this->strText));
    }

    /* Test Flesch Kincaid Grade Level
    -------------------- */
    public function testFleschKincaidGradeLevel()
    {
        $this->assertEquals(12.1, $this->TextStatistics->flesch_kincaid_grade_level($this->strText));
    }

    /* Test Gunning Fog Score
    -------------------- */
    public function testGunningFogScore()
    {
        $this->assertEquals(14.4, $this->TextStatistics->gunning_fog_score($this->strText));
    }

    /* Test Coleman Liau Index
    -------------------- */
    public function testColemanLiauIndex()
    {
        $this->assertEquals(10.1, $this->TextStatistics->coleman_liau_index($this->strText));
    }

    /* Test SMOG Index
    -------------------- */
    public function testSMOGIndex()
    {
        $this->assertEquals(9.9, $this->TextStatistics->smog_index($this->strText));
    }

    /* Test Automated Readability Index
    -------------------- */
    public function testAutomatedReadabilityIndex()
    {
        $this->assertEquals(11.8, $this->TextStatistics->automated_readability_index($this->strText));
    }
    }
