<?php

    // Include PHPUnit
    require_once('PHPUnit/Framework.php');

    // Include the email address validator class
    require_once('../TextStatistics.php');
     
    class TextStatisticsMelvilleMobyDick extends PHPUnit_Framework_TestCase {

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
            (206.835 - (1.015 * (word_count / sentence_count)) - (84.6 * (syllable_count / word_count))) = 53.380886194029850746268656716418

            Flesch-Kincaid Grade Level
            ((0.39 * (word_count / sentence_count)) + (11.8 * (syllable_count / word_count)) - 15.59) = 12.055516169154228855721393034826

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

        public function setUp() {
            $this->TextStatistics = new TextStatistics();
        }

        public function tearDown() {
            unset($this->objTextStatistics);
        }

        /* Test Syllables
        -------------------- */

        public function testKiplingSyllables() { // The Words from If, in order            
            $this->assertEquals(1, $this->TextStatistics->syllable_count('Call'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('me'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('Ishmael'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('Some'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('years'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('ago'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('never'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('mind'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('how'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('long'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('precisely'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('having'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('little'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('or'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('no'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('money'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('in'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('my'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('purse'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('and'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('nothing'));
            $this->assertEquals(4, $this->TextStatistics->syllable_count('particular'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('to'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('interest'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('me'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('on'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('shore'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('I'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('thought'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('I'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('would'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('sail'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('about'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('a'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('little'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('and'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('see'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('the'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('watery'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('part'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('of'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('the'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('world'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('It'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('is'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('a'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('way'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('I'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('have'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('of'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('driving'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('off'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('the'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('spleen'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('and'));
            $this->assertEquals(4, $this->TextStatistics->syllable_count('regulating'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('the'));
            $this->assertEquals(4, $this->TextStatistics->syllable_count('circulation'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('Whenever'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('I'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('find'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('myself'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('growing'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('grim'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('about'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('the'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('mouth'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('whenever'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('it'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('is'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('a'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('damp'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('drizzly'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('November'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('in'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('my'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('soul'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('whenever'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('I'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('find'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('myself'));
            $this->assertEquals(6, $this->TextStatistics->syllable_count('involuntarily'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('pausing'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('before'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('coffin'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('warehouses'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('and'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('bringing'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('up'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('the'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('rear'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('of'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('every'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('funeral'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('I'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('meet'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('and'));
            $this->assertEquals(4, $this->TextStatistics->syllable_count('especially'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('whenever'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('my'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('hypos'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('get'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('such'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('an'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('upper'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('hand'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('of'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('me'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('that'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('it'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('requires'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('a'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('strong'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('moral'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('principle'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('to'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('prevent'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('me'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('from'));
            $this->assertEquals(5, $this->TextStatistics->syllable_count('deliberately'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('stepping'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('into'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('the'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('street'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('and'));
            $this->assertEquals(5, $this->TextStatistics->syllable_count('methodically'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('knocking'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('people\'s'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('hats'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('off'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('then'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('I'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('account'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('it'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('high'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('time'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('to'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('get'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('to'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('sea'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('as'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('soon'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('as'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('I'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('can'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('This'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('is'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('my'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('substitute'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('for'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('pistol'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('and'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('ball'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('With'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('a'));
            $this->assertEquals(5, $this->TextStatistics->syllable_count('philosophical'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('flourish'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('Cato'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('throws'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('himself'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('upon'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('his'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('sword'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('I'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('quietly'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('take'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('to'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('the'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('ship'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('There'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('is'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('nothing'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('surprising'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('in'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('this'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('If'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('they'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('but'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('knew'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('it'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('almost'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('all'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('men'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('in'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('their'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('degree'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('some'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('time'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('or'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('other'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('cherish'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('very'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('nearly'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('the'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('same'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('feelings'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('towards'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('the'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('ocean'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('with'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('me'));
        }

        /* Test Word Count
        -------------------- */

        public function testWordCount() {
            $this->assertEquals(201, $this->TextStatistics->word_count($this->strText));
        }

        /* Test Long Word Count
        -------------------- */

        public function testLongWordCount() {
            $this->assertEquals(23, $this->TextStatistics->words_with_three_syllables($this->strText, true)); // Include proper nouns
            $this->assertEquals(22, $this->TextStatistics->words_with_three_syllables($this->strText, false)); // Don't include proper nouns
        }

        /* Test Sentences
        -------------------- */

        public function testSentenceCount() {
            $this->assertEquals(8, $this->TextStatistics->sentence_count($this->strText));
        }

        /* Test Letter Count
        -------------------- */

        public function testTextLengthCheck() {
            $this->assertEquals(884, $this->TextStatistics->letter_count($this->strText));
        }

        /* Test Flesch Kincaid Reading Ease
        -------------------- */

        public function testFleschKincaidReadingEase() {
            $this->assertEquals(53.4, $this->TextStatistics->flesch_kincaid_reading_ease($this->strText));
        }

        /* Test Flesch Kincaid Grade Level
        -------------------- */

        public function testFleschKincaidGradeLevel() {
            $this->assertEquals(12.1, $this->TextStatistics->flesch_kincaid_grade_level($this->strText));
        }

        /* Test Gunning Fog Score
        -------------------- */

        public function testGunningFogScore() {
            $this->assertEquals(14.4, $this->TextStatistics->gunning_fog_score($this->strText));
        }

        /* Test Coleman Liau Index
        -------------------- */

        public function testColemanLiauIndex() {
            $this->assertEquals(10.1, $this->TextStatistics->coleman_liau_index($this->strText));
        }

        /* Test SMOG Index
        -------------------- */

        public function testSMOGIndex() {
            $this->assertEquals(9.9, $this->TextStatistics->smog_index($this->strText));
        }

        /* Test Automated Readability Index
        -------------------- */

        public function testAutomatedReadabilityIndex() {
            $this->assertEquals(11.8, $this->TextStatistics->automated_readability_index($this->strText));
        }
    
    }

?>