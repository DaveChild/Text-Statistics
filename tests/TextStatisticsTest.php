<?php

    // Include PHPUnit
    require_once('PHPUnit/Framework.php');

    // Include the email address validator class
    require_once('../TextStatistics.php');
     
    class TextStatisticsTest extends PHPUnit_Framework_TestCase {

        /*
            
            This file contains the more basic tests - short sentences, word counts,
            sentence counts, and so on. Longer texts are split into their own test 
            files for convenience.

        */

        protected $TextStatistics = null;

        public function setUp() {
            $this->TextStatistics = new TextStatistics();
        }

        public function tearDown() {
            unset($this->objTextStatistics);
        }

        /* Test Syllables
        -------------------- */

        public function testSyllableCountBasicWords() { // "Normal" words
            $this->assertEquals(1, $this->TextStatistics->syllable_count('a'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('was'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('the'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('and'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('foobar'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('hello'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('world'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('wonderful'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('simple'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('easy'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('hard'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('quick'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('brown'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('fox'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('jumped'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('over'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('lazy'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('dog'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('camera'));
        }

        public function testSyllableCountComplexWords() { // Odd syllables, long words, difficult sounds
            $this->assertEquals(12, $this->TextStatistics->syllable_count('antidisestablishmentarianism'));
            $this->assertEquals(14, $this->TextStatistics->syllable_count('supercalifragilisticexpialidocious'));
            $this->assertEquals(8, $this->TextStatistics->syllable_count('chlorofluorocarbonation'));
            $this->assertEquals(4, $this->TextStatistics->syllable_count('forethoughtfulness'));
            $this->assertEquals(4, $this->TextStatistics->syllable_count('phosphorescent'));
            $this->assertEquals(5, $this->TextStatistics->syllable_count('theoretician'));
            $this->assertEquals(5, $this->TextStatistics->syllable_count('promiscuity'));
            $this->assertEquals(4, $this->TextStatistics->syllable_count('unbutlering'));
            $this->assertEquals(5, $this->TextStatistics->syllable_count('continuity'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('craunched'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('squelched'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('scrounge'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('coughed'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('smile'));
            $this->assertEquals(4, $this->TextStatistics->syllable_count('monopoly'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('doughey'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('doughier'));
            $this->assertEquals(4, $this->TextStatistics->syllable_count('leguminous'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('thoroughbreds'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('special'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('delicious'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('spatial'));
            $this->assertEquals(4, $this->TextStatistics->syllable_count('pacifism'));
            $this->assertEquals(4, $this->TextStatistics->syllable_count('coagulant'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('shouldn\'t'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('mcdonald'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('audience'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('finance'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('prevalence'));
            $this->assertEquals(5, $this->TextStatistics->syllable_count('impropriety'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('alien'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('dreadnought'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('verandah'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('similar'));
            $this->assertEquals(4, $this->TextStatistics->syllable_count('similarly'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('central'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('cyst'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('term'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('order'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('fur'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('sugar'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('paper'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('make'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('gem'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('program'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('hopeless'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('hopelessly'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('careful'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('carefully'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('stuffy'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('thistle'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('teacher'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('unhappy'));
            $this->assertEquals(5, $this->TextStatistics->syllable_count('ambiguity'));
            $this->assertEquals(4, $this->TextStatistics->syllable_count('validity'));
            $this->assertEquals(4, $this->TextStatistics->syllable_count('ambiguous'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('deserve'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('blooper'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('scooped'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('deserve'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('deal'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('death'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('dearth'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('deign'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('reign'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('bedsore'));
            $this->assertEquals(5, $this->TextStatistics->syllable_count('anorexia'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('anymore'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('cored'));
            $this->assertEquals(1, $this->TextStatistics->syllable_count('sore'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('foremost'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('restore'));
            $this->assertEquals(2, $this->TextStatistics->syllable_count('minute'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('manticores'));
            $this->assertEquals(4, $this->TextStatistics->syllable_count('asparagus'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('unexplored'));
            $this->assertEquals(4, $this->TextStatistics->syllable_count('unexploded'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('CAPITALS'));
        }

        // These are fairly common words that are exceptions to given rules and that can not
        // easily be programmed for. I've added them here for documentation purposes as much
        // as anything else. If you find a way to program rules for any of these, move them
        // into the section above. Many compound words will end up here.
        public function testSyllableCountProgrammedExceptions() { 
            $this->assertEquals(3, $this->TextStatistics->syllable_count('simile'));
            // Compounds that have caused problems so far
            // Problem: far too many compound words to list exhaustively.
            $this->assertEquals(2, $this->TextStatistics->syllable_count('shoreline'));
            $this->assertEquals(3, $this->TextStatistics->syllable_count('forever'));
        }

        public function testAverageSyllablesPerWord() {
            $this->assertEquals(1, $this->TextStatistics->average_syllables_per_word('and then there was one'));
            $this->assertEquals(2, $this->TextStatistics->average_syllables_per_word('because special ducklings deserve rainbows'));
            $this->assertEquals(1.5, $this->TextStatistics->average_syllables_per_word('and then there was one because special ducklings deserve rainbows'));
        }

        /* Test Words
        -------------------- */

        public function testWordCount() {
            $this->assertEquals(9, $this->TextStatistics->word_count('The quick brown fox jumped over the lazy dog'));
            $this->assertEquals(9, $this->TextStatistics->word_count('The quick brown fox jumped over the lazy dog.'));
            $this->assertEquals(9, $this->TextStatistics->word_count('The quick brown fox jumped over the lazy dog. '));
            $this->assertEquals(9, $this->TextStatistics->word_count(' The quick brown fox jumped over the lazy dog. '));
            $this->assertEquals(9, $this->TextStatistics->word_count(' The  quick brown fox jumped over the lazy dog. '));
            $this->assertEquals(2, $this->TextStatistics->word_count('Yes. No.'));
            $this->assertEquals(2, $this->TextStatistics->word_count('Yes.No.'));
            $this->assertEquals(2, $this->TextStatistics->word_count('Yes.No.'));
            $this->assertEquals(2, $this->TextStatistics->word_count('Yes . No.'));
            $this->assertEquals(2, $this->TextStatistics->word_count('Yes .No.'));
            $this->assertEquals(2, $this->TextStatistics->word_count('Yes - No. '));
        }

        public function testCheckPercentageWordsWithThreeSyllables() {
            $this->assertEquals(9, number_format($this->TextStatistics->percentage_words_with_three_syllables('there is just one word with three syllables in this sentence')));
            $this->assertEquals(9, number_format($this->TextStatistics->percentage_words_with_three_syllables('there is just one word with three syllables in this sentence', true)));
            $this->assertEquals(0, number_format($this->TextStatistics->percentage_words_with_three_syllables('there are no valid words with three Syllables in this sentence', false)));
            $this->assertEquals(5, number_format($this->TextStatistics->percentage_words_with_three_syllables('there is one and only one word with three or more syllables in this long boring sentence of twenty words')));
            $this->assertEquals(10, number_format($this->TextStatistics->percentage_words_with_three_syllables('there are two and only two words with three or more syllables in this long sentence of exactly twenty words')));
            $this->assertEquals(5, number_format($this->TextStatistics->percentage_words_with_three_syllables('there is Actually only one valid word with three or more syllables in this long sentence of Exactly twenty words', false)));
            $this->assertEquals(0, number_format($this->TextStatistics->percentage_words_with_three_syllables('no long words in this sentence')));
            $this->assertEquals(0, number_format($this->TextStatistics->percentage_words_with_three_syllables('no long valid words in this sentence because the test ignores proper case words like this Behemoth', false)));
        }

        public function testTextLengthCheck() {
            $this->assertEquals(1, $this->TextStatistics->letter_count('a'));
            $this->assertEquals(0, $this->TextStatistics->letter_count(''));
            $this->assertEquals(46, $this->TextStatistics->letter_count('this sentence has 30 characters, not including the digits'));
        }

        /* Test Sentences
        -------------------- */

        public function testSentenceCount() {
            $this->assertEquals(1, $this->TextStatistics->sentence_count('This is a sentence'));
            $this->assertEquals(1, $this->TextStatistics->sentence_count('This is a sentence.'));
            $this->assertEquals(1, $this->TextStatistics->sentence_count('This is a sentence!'));
            $this->assertEquals(1, $this->TextStatistics->sentence_count('This is a sentence?'));
            $this->assertEquals(1, $this->TextStatistics->sentence_count('This is a sentence..'));
            $this->assertEquals(2, $this->TextStatistics->sentence_count('This is a sentence. So is this.'));
            $this->assertEquals(2, $this->TextStatistics->sentence_count("This is a sentence. \n\n So is this, but this is multi-line!"));
            $this->assertEquals(2, $this->TextStatistics->sentence_count('This is a sentence,. So is this.'));
            $this->assertEquals(2, $this->TextStatistics->sentence_count('This is a sentence!? So is this.'));
            $this->assertEquals(3, $this->TextStatistics->sentence_count('This is a sentence. So is this. And this one as well.'));
            $this->assertEquals(1, $this->TextStatistics->sentence_count('This is a sentence - but just one.'));
            $this->assertEquals(1, $this->TextStatistics->sentence_count('This is a sentence (but just one).'));
        }

        public function testAverageWordsPerSentence() {
            $this->assertEquals(4, $this->TextStatistics->average_words_per_sentence('This is a sentence'));
            $this->assertEquals(4, $this->TextStatistics->average_words_per_sentence('This is a sentence.'));
            $this->assertEquals(4, $this->TextStatistics->average_words_per_sentence('This is a sentence. '));
            $this->assertEquals(4, $this->TextStatistics->average_words_per_sentence('This is a sentence. This is a sentence'));
            $this->assertEquals(4, $this->TextStatistics->average_words_per_sentence('This is a sentence. This is a sentence.'));
            $this->assertEquals(4, $this->TextStatistics->average_words_per_sentence('This, is - a sentence . This is a sentence. '));
            $this->assertEquals(5.5, $this->TextStatistics->average_words_per_sentence('This is a sentence with extra text. This is a sentence. '));
            $this->assertEquals(6, $this->TextStatistics->average_words_per_sentence('This is a sentence with some extra text. This is a sentence. '));
        }

        /* Test Scores
        -------------------- */

        // Please note that scores for all of these sentences and scoring systems have all been calculated by hand and should therefore be accurate.
        // All values have been rounded to a single decimal point. PHP can be temperamental when it comes to floats.

        public function testFleschKincaidReadingEase() {
            $this->assertEquals(121.2, $this->TextStatistics->flesch_kincaid_reading_ease('This. Is. A. Nice. Set. Of. Small. Words. Of. One. Part. Each.')); // Best score possible
            $this->assertEquals(94.3, $this->TextStatistics->flesch_kincaid_reading_ease('The quick brown fox jumped over the lazy dog.'));
            $this->assertEquals(94.3, $this->TextStatistics->flesch_kincaid_reading_ease('The quick brown fox jumped over the lazy dog. The quick brown fox jumped over the lazy dog.'));
            $this->assertEquals(94.3, $this->TextStatistics->flesch_kincaid_reading_ease('The quick brown fox jumped over the lazy dog. The quick brown fox jumped over the lazy dog'));
            $this->assertEquals(94.3, $this->TextStatistics->flesch_kincaid_reading_ease("The quick brown fox jumped over the lazy dog. \n\n The quick brown fox jumped over the lazy dog."));
            $this->assertEquals(50.5, $this->TextStatistics->flesch_kincaid_reading_ease('Now it is time for a more complicated sentence, including several longer words.'));
        }

        public function testFleschKincaidGradeLevel() {
            $this->assertEquals(-3.4, $this->TextStatistics->flesch_kincaid_grade_level('This. Is. A. Nice. Set. Of. Small. Words. Of. One. Part. Each.')); // Best score possible
            $this->assertEquals(2.3, $this->TextStatistics->flesch_kincaid_grade_level('The quick brown fox jumped over the lazy dog.'));
            $this->assertEquals(2.3, $this->TextStatistics->flesch_kincaid_grade_level('The quick brown fox jumped over the lazy dog. The quick brown fox jumped over the lazy dog.'));
            $this->assertEquals(2.3, $this->TextStatistics->flesch_kincaid_grade_level('The quick brown fox jumped over the lazy dog. The quick brown fox jumped over the lazy dog'));
            $this->assertEquals(2.3, $this->TextStatistics->flesch_kincaid_grade_level("The quick brown fox jumped over the lazy dog. \n\n The quick brown fox jumped over the lazy dog."));
            $this->assertEquals(9.4, $this->TextStatistics->flesch_kincaid_grade_level('Now it is time for a more complicated sentence, including several longer words.'));
        }

        public function testGunningFogScore() {
            $this->assertEquals(0.4, $this->TextStatistics->gunning_fog_score('This. Is. A. Nice. Set. Of. Small. Words. Of. One. Part. Each.')); // Best possible score
            $this->assertEquals(3.6, $this->TextStatistics->gunning_fog_score('The quick brown fox jumped over the lazy dog.'));
            $this->assertEquals(3.6, $this->TextStatistics->gunning_fog_score('The quick brown fox jumped over the lazy dog. The quick brown fox jumped over the lazy dog.'));
            $this->assertEquals(3.6, $this->TextStatistics->gunning_fog_score("The quick brown fox jumped over the lazy dog. \n\n The quick brown fox jumped over the lazy dog."));
            $this->assertEquals(3.6, $this->TextStatistics->gunning_fog_score('The quick brown fox jumped over the lazy dog. The quick brown fox jumped over the lazy dog'));
            $this->assertEquals(14.4, $this->TextStatistics->gunning_fog_score('Now it is time for a more complicated sentence, including several longer words.'));
            $this->assertEquals(8.3, $this->TextStatistics->gunning_fog_score('Now it is time for a more Complicated sentence, including Several longer words.')); // Two proper nouns, ignored
        }

        public function testColemanLiauIndex() {
            $this->assertEquals(3.0, $this->TextStatistics->coleman_liau_index('This. Is. A. Nice. Set. Of. Small. Words. Of. One. Part. Each.')); // Best possible score would be if all words were 1 character
            $this->assertEquals(7.7, $this->TextStatistics->coleman_liau_index('The quick brown fox jumped over the lazy dog.'));
            $this->assertEquals(7.7, $this->TextStatistics->coleman_liau_index('The quick brown fox jumped over the lazy dog. The quick brown fox jumped over the lazy dog.'));
            $this->assertEquals(7.7, $this->TextStatistics->coleman_liau_index("The quick brown fox jumped over the lazy dog. \n\n The quick brown fox jumped over the lazy dog."));
            $this->assertEquals(7.7, $this->TextStatistics->coleman_liau_index('The quick brown fox jumped over the lazy dog. The quick brown fox jumped over the lazy dog'));
            $this->assertEquals(13.6, $this->TextStatistics->coleman_liau_index('Now it is time for a more complicated sentence, including several longer words.'));
        }

        public function testSMOGIndex() {
            $this->assertEquals(1.8, $this->TextStatistics->smog_index('This. Is. A. Nice. Set. Of. Small. Words. Of. One. Part. Each.')); // Should be 1.8 for any text with no words of 3+ syllables
            $this->assertEquals(1.8, $this->TextStatistics->smog_index('The quick brown fox jumped over the lazy dog.'));
            $this->assertEquals(1.8, $this->TextStatistics->smog_index('The quick brown fox jumped over the lazy dog. The quick brown fox jumped over the lazy dog.'));
            $this->assertEquals(1.8, $this->TextStatistics->smog_index("The quick brown fox jumped over the lazy dog. \n\n The quick brown fox jumped over the lazy dog."));
            $this->assertEquals(1.8, $this->TextStatistics->smog_index('The quick brown fox jumped over the lazy dog. The quick brown fox jumped over the lazy dog'));
            $this->assertEquals(10.1, $this->TextStatistics->smog_index('Now it is time for a more complicated sentence, including several longer words.'));
        }

        public function testAutomatedReadabilityIndex() {
            $this->assertEquals(-5.6, $this->TextStatistics->automated_readability_index('This. Is. A. Nice. Set. Of. Small. Words. Of. One. Part. Each.'));
            $this->assertEquals(1.9, $this->TextStatistics->automated_readability_index('The quick brown fox jumped over the lazy dog.'));
            $this->assertEquals(1.9, $this->TextStatistics->automated_readability_index('The quick brown fox jumped over the lazy dog. The quick brown fox jumped over the lazy dog.'));
            $this->assertEquals(1.9, $this->TextStatistics->automated_readability_index("The quick brown fox jumped over the lazy dog. \n\n The quick brown fox jumped over the lazy dog."));
            $this->assertEquals(1.9, $this->TextStatistics->automated_readability_index('The quick brown fox jumped over the lazy dog. The quick brown fox jumped over the lazy dog'));
            $this->assertEquals(8.6, $this->TextStatistics->automated_readability_index('Now it is time for a more complicated sentence, including several longer words.'));
        }

    }

?>