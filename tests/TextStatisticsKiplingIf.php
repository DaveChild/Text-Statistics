<?php

    // Include PHPUnit
    require_once('PHPUnit/Framework.php');

    // Include the email address validator class
    require_once('../TextStatistics.php');
     
    class TextStatisticsKiplingIf extends PHPUnit_Framework_TestCase {

        /*
            
            Text
            --------------------------------------------------------
            If by Rudyard Kipling

            If you can keep your head when all about you 
            Are losing theirs and blaming it on you, 
            If you can trust yourself when all men doubt you 
            But make allowance for their doubting too, 
            If you can wait and not be tired by waiting, 
            Or being lied about, don't deal in lies, 
            Or being hated, don't give way to hating, 
            And yet don't look too good, nor talk too wise: 

            If you can dream - and not make dreams your master, 
            If you can think - and not make thoughts your aim; 
            If you can meet with Triumph and Disaster 
            And treat those two impostors just the same; 
            If you can bear to hear the truth you've spoken 
            Twisted by knaves to make a trap for fools, 
            Or watch the things you gave your life to, broken, 
            And stoop and build 'em up with worn-out tools: 

            If you can make one heap of all your winnings 
            And risk it all on one turn of pitch-and-toss, 
            And lose, and start again at your beginnings 
            And never breath a word about your loss; 
            If you can force your heart and nerve and sinew 
            To serve your turn long after they are gone, 
            And so hold on when there is nothing in you 
            Except the Will which says to them: "Hold on" 

            If you can talk with crowds and keep your virtue, 
            Or walk with kings - nor lose the common touch, 
            If neither foes nor loving friends can hurt you; 
            If all men count with you, but none too much, 
            If you can fill the unforgiving minute 
            With sixty seconds' worth of distance run, 
            Yours is the Earth and everything that's in it, 
            And - which is more - you'll be a Man, my son!

            Data
            --------------------------------------------------------
            Letter Count:                                       1125
            Word Count:                                          292
            3+ syllables:                                          6
            Syllable Count:                                      338
            Sentence Count:                                        1
            Note: 1 of the 3+ syllable words is a proper noun and
            will be ignored by the Gunning-Fog Score.

            Manually Calculated Scores
            --------------------------------------------------------
            Flesch-Kincaid Reading Ease
            (206.835 - (1.015 * (word_count / sentence_count)) - (84.6 * (syllable_count / word_count))) = -187.47239726027397260273972602738

            Flesch-Kincaid Grade Level
            ((0.39 * (word_count / sentence_count)) + (11.8 * (syllable_count / word_count)) - 15.59) = 111.9489041095890410958904109589

            Gunning-Fog Score
            (((word_count / sentence_count) + (100 * (long_word_count / word_count ))) * 0.4) = 117.48493150684931506849315068493

            Coleman-Liau Index
            ((5.89 * (letter_count / word_count)) - (0.3 * (sentence_count / word_count)) - 15.8) = 6.8916095890410958904109589041096

            SMOG Index
            (1.043 * sqrt((long_word_count * (30 / sentence_count)) + 3.1291)) = 14.114418454399741934838352157075

            Automated Readability Index
            ((4.71 * (letter_count / word_count)) + (0.5 * (word_count / sentence_count)) - 21.43) = 142.7164041095890410958904109589

        */

        protected $TextStatistics = null;
        protected $strText = "If you can keep your head when all about you \n Are losing theirs and blaming it on you, \n If you can trust yourself when all men doubt you \n But make allowance for their doubting too, \n If you can wait and not be tired by waiting, \n Or being lied about, don't deal in lies, \n Or being hated, don't give way to hating, \n And yet don't look too good, nor talk too wise: \n\n If you can dream - and not make dreams your master, \n If you can think - and not make thoughts your aim; \n If you can meet with Triumph and Disaster \n And treat those two impostors just the same; \n If you can bear to hear the truth you've spoken \n Twisted by knaves to make a trap for fools, \n Or watch the things you gave your life to, broken, \n And stoop and build 'em up with worn-out tools: \n\n If you can make one heap of all your winnings \n And risk it all on one turn of pitch-and-toss, \n And lose, and start again at your beginnings \n And never breath a word about your loss; \n If you can force your heart and nerve and sinew \n To serve your turn long after they are gone, \n And so hold on when there is nothing in you \n Except the Will which says to them: \"Hold on\" \n\n If you can talk with crowds and keep your virtue, \n Or walk with kings - nor lose the common touch, \n If neither foes nor loving friends can hurt you; \n If all men count with you, but none too much, \n If you can fill the unforgiving minute \n With sixty seconds' worth of distance run, \n Yours is the Earth and everything that's in it, \n And - which is more - you'll be a Man, my son!";

        public function setUp() {
            $this->TextStatistics = new TextStatistics();
        }

        public function tearDown() {
            unset($this->objTextStatistics);
        }

        /* Test Syllables
        -------------------- */

        public function testKiplingSyllables() { // The Words from If, in order
            $this->assertEquals($this->TextStatistics->syllable_count('If'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('you'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('can'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('keep'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('your'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('head'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('when'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('all'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('about'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('you'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('Are'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('losing'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('theirs'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('and'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('blaming'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('it'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('on'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('you,'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('If'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('you'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('can'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('trust'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('yourself'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('when'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('all'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('men'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('doubt'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('you'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('But'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('make'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('allowance'), 3);
            $this->assertEquals($this->TextStatistics->syllable_count('for'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('their'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('doubting'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('too,'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('If'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('you'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('can'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('wait'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('and'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('not'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('be'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('tired'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('by'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('waiting,'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('Or'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('being'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('lied'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('about,'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('don\'t'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('deal'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('in'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('lies,'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('Or'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('being'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('hated,'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('don\'t'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('give'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('way'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('to'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('hating,'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('And'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('yet'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('don\'t'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('look'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('too'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('good,'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('nor'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('talk'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('too'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('wise:'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('If'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('you'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('can'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('dream'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('-and'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('not'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('make'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('dreams'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('your'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('master,'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('If'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('you'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('can'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('think'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('-and'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('not'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('make'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('thoughts'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('your'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('aim;'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('If'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('you'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('can'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('meet'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('with'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('Triumph'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('and'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('Disaster'), 3);
            $this->assertEquals($this->TextStatistics->syllable_count('And'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('treat'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('those'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('two'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('impostors'), 3);
            $this->assertEquals($this->TextStatistics->syllable_count('just'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('the'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('same;'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('If'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('you'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('can'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('bear'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('to'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('hear'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('the'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('truth'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('you\'ve'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('spoken'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('Twisted'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('by'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('knaves'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('to'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('make'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('a'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('trap'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('for'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('fools,'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('Or'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('watch'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('the'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('things'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('you'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('gave'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('your'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('life'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('to,'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('broken,'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('And'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('stoop'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('and'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('build'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('\'em'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('up'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('with'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('worn'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('-out'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('tools:'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('If'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('you'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('can'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('make'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('one'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('heap'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('of'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('all'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('your'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('winnings'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('And'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('risk'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('it'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('all'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('on'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('one'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('turn'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('of'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('pitch'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('-and'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('-toss,'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('And'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('lose,'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('and'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('start'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('again'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('at'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('your'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('beginnings'), 3);
            $this->assertEquals($this->TextStatistics->syllable_count('And'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('never'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('breath'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('a'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('word'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('about'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('your'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('loss;'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('If'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('you'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('can'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('force'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('your'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('heart'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('and'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('nerve'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('and'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('sinew'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('To'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('serve'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('your'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('turn'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('long'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('after'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('they'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('are'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('gone,'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('And'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('so'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('hold'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('on'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('when'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('there'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('is'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('nothing'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('in'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('you'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('Except'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('the'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('Will'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('which'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('says'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('to'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('them:'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('"Hold'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('on!"'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('If'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('you'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('can'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('talk'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('with'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('crowds'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('and'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('keep'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('your'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('virtue,'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('Or'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('walk'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('with'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('kings'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('-nor'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('lose'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('the'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('common'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('touch,'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('If'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('neither'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('foes'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('nor'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('loving'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('friends'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('can'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('hurt'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('you;'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('If'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('all'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('men'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('count'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('with'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('you,'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('but'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('none'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('too'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('much'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('If'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('you'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('can'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('fill'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('the'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('unforgiving'), 4);
            $this->assertEquals($this->TextStatistics->syllable_count('minute'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('With'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('sixty'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('seconds\''), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('worth'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('of'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('distance'), 2);
            $this->assertEquals($this->TextStatistics->syllable_count('run,'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('Yours'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('is'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('the'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('Earth'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('and'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('everything'), 4);
            $this->assertEquals($this->TextStatistics->syllable_count('that\'s'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('in'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('it,'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('And'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('which'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('is'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('more'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('you\'ll'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('be'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('a'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('Man,'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('my'), 1);
            $this->assertEquals($this->TextStatistics->syllable_count('son!'), 1);
        }

        /* Test Words
        -------------------- */

        public function testWordCount() {
            $this->assertEquals(292, $this->TextStatistics->word_count($this->strText));
        }

        /* Test Sentences
        -------------------- */

        public function testSentenceCount() {
            $this->assertEquals(1, $this->TextStatistics->sentence_count($this->strText));
        }

        /* Test Letter Count
        -------------------- */

        public function testTextLengthCheck() {
            $this->assertEquals(1125, $this->TextStatistics->letter_count($this->strText));
        }

        /* Test Flesch Kincaid Reading Ease
        -------------------- */

        public function testFleschKincaidReadingEase() {
            $this->assertEquals(-187.5, $this->TextStatistics->flesch_kincaid_reading_ease($this->strText));
        }

        /* Test Flesch Kincaid Grade Level
        -------------------- */

        public function testFleschKincaidGradeLevel() {
            $this->assertEquals(111.9, $this->TextStatistics->flesch_kincaid_grade_level($this->strText));
        }

        /* Test Gunning Fog Score
        -------------------- */

        public function testGunningFogScore() {
            $this->assertEquals(117.5, $this->TextStatistics->gunning_fog_score($this->strText));
        }

        /* Test Coleman Liau Index
        -------------------- */

        public function testColemanLiauIndex() {
            $this->assertEquals(6.9, $this->TextStatistics->coleman_liau_index($this->strText));
        }

        /* Test SMOG Index
        -------------------- */

        public function testSMOGIndex() {
            $this->assertEquals(14.1, $this->TextStatistics->smog_index($this->strText));
        }

        /* Test Automated Readability Index
        -------------------- */

        public function testAutomatedReadabilityIndex() {
            $this->assertEquals(142.7, $this->TextStatistics->automated_readability_index($this->strText));
        }
    
    }

?>