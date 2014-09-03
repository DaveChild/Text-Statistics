<?php

class TextStatisticsKiplingIf extends PHPUnit_Framework_TestCase
{

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
        (206.835 - (1.015 * (word_count / sentence_count)) - (84.6 * (syllableCount / word_count))) = -187.47239726027397260273972602738

        Flesch-Kincaid Grade Level
        ((0.39 * (word_count / sentence_count)) + (11.8 * (syllableCount / word_count)) - 15.59) = 111.9489041095890410958904109589

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
    public function testKiplingSyllables()
    { // The Words from If, in order
        $this->assertEquals($this->TextStatistics->syllableCount('If'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('you'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('can'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('keep'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('your'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('head'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('when'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('all'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('about'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('you'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('Are'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('losing'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('theirs'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('and'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('blaming'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('it'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('on'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('you,'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('If'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('you'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('can'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('trust'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('yourself'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('when'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('all'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('men'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('doubt'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('you'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('But'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('make'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('allowance'), 3);
        $this->assertEquals($this->TextStatistics->syllableCount('for'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('their'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('doubting'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('too,'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('If'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('you'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('can'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('wait'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('and'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('not'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('be'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('tired'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('by'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('waiting,'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('Or'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('being'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('lied'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('about,'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('don\'t'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('deal'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('in'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('lies,'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('Or'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('being'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('hated,'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('don\'t'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('give'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('way'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('to'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('hating,'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('And'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('yet'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('don\'t'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('look'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('too'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('good,'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('nor'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('talk'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('too'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('wise:'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('If'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('you'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('can'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('dream'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('-and'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('not'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('make'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('dreams'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('your'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('master,'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('If'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('you'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('can'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('think'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('-and'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('not'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('make'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('thoughts'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('your'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('aim;'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('If'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('you'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('can'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('meet'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('with'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('Triumph'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('and'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('Disaster'), 3);
        $this->assertEquals($this->TextStatistics->syllableCount('And'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('treat'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('those'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('two'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('impostors'), 3);
        $this->assertEquals($this->TextStatistics->syllableCount('just'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('the'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('same;'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('If'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('you'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('can'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('bear'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('to'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('hear'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('the'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('truth'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('you\'ve'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('spoken'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('Twisted'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('by'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('knaves'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('to'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('make'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('a'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('trap'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('for'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('fools,'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('Or'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('watch'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('the'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('things'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('you'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('gave'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('your'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('life'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('to,'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('broken,'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('And'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('stoop'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('and'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('build'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('\'em'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('up'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('with'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('worn'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('-out'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('tools:'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('If'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('you'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('can'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('make'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('one'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('heap'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('of'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('all'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('your'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('winnings'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('And'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('risk'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('it'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('all'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('on'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('one'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('turn'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('of'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('pitch'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('-and'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('-toss,'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('And'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('lose,'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('and'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('start'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('again'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('at'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('your'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('beginnings'), 3);
        $this->assertEquals($this->TextStatistics->syllableCount('And'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('never'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('breath'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('a'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('word'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('about'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('your'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('loss;'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('If'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('you'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('can'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('force'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('your'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('heart'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('and'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('nerve'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('and'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('sinew'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('To'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('serve'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('your'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('turn'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('long'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('after'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('they'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('are'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('gone,'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('And'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('so'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('hold'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('on'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('when'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('there'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('is'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('nothing'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('in'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('you'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('Except'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('the'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('Will'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('which'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('says'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('to'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('them:'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('"Hold'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('on!"'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('If'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('you'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('can'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('talk'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('with'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('crowds'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('and'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('keep'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('your'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('virtue,'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('Or'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('walk'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('with'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('kings'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('-nor'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('lose'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('the'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('common'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('touch,'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('If'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('neither'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('foes'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('nor'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('loving'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('friends'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('can'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('hurt'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('you;'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('If'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('all'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('men'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('count'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('with'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('you,'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('but'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('none'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('too'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('much'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('If'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('you'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('can'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('fill'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('the'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('unforgiving'), 4);
        $this->assertEquals($this->TextStatistics->syllableCount('minute'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('With'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('sixty'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('seconds\''), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('worth'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('of'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('distance'), 2);
        $this->assertEquals($this->TextStatistics->syllableCount('run,'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('Yours'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('is'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('the'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('Earth'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('and'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('everything'), 4);
        $this->assertEquals($this->TextStatistics->syllableCount('that\'s'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('in'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('it,'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('And'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('which'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('is'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('more'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('you\'ll'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('be'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('a'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('Man,'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('my'), 1);
        $this->assertEquals($this->TextStatistics->syllableCount('son!'), 1);
    }

    /* Test Total Letters
    -------------------- */
    public function testLetterCount()
    {
        $this->assertEquals(1125, $this->TextStatistics->letterCount($this->strText));
    }

    /* Test Total Syllables
    -------------------- */
    public function testSyllableCount()
    {
        $this->assertEquals(338, $this->TextStatistics->totalSyllables($this->strText));
    }

    /* Test Words
    -------------------- */
    public function testWordCount()
    {
        $this->assertEquals(292, $this->TextStatistics->wordCount($this->strText));
    }

    /* Test Sentences
    -------------------- */
    public function testSentenceCount()
    {
        $this->assertEquals(4, $this->TextStatistics->sentenceCount($this->strText));
    }

    /* Test Letter Count
    -------------------- */
    public function testTextLengthCheck()
    {
        $this->assertEquals(1125,  $this->TextStatistics->letterCount($this->strText));
    }

    /* Test Flesch Kincaid Reading Ease
    -------------------- */
    public function testFleschKincaidReadingEase()
    {
        $this->assertEquals(34.8, $this->TextStatistics->flesch_kincaid_reading_ease($this->strText));
    }

    /* Test Flesch Kincaid Grade Level
    -------------------- */
    public function testFleschKincaidGradeLevel()
    {
        $this->assertEquals(26.5, $this->TextStatistics->flesch_kincaid_grade_level($this->strText));
    }

    /* Test Gunning Fog Score
    -------------------- */
    public function testGunningFogScore()
    {
        $this->assertEquals(29.9, $this->TextStatistics->gunning_fog_score($this->strText));
    }

    /* Test Coleman Liau Index
    -------------------- */
    public function testColemanLiauIndex()
    {
        $this->assertEquals(6.9, $this->TextStatistics->coleman_liau_index($this->strText));
    }

    /* Test SMOG Index
    -------------------- */
    public function testSMOGIndex()
    {
        $this->assertEquals(7.2, $this->TextStatistics->smog_index($this->strText));
    }

    /* Test Automated Readability Index
    -------------------- */
    public function testAutomatedReadabilityIndex()
    {
        $this->assertEquals(33.2, $this->TextStatistics->automated_readability_index($this->strText));
    }
}
