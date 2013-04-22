<?php

class Game {
        
    public $cards;
 	public $hand;
 	public $deck;
    
    function __construct ($lineOfCards) {
        $this->hand = new Hand();
        $this->deck = new Deck();
        $this->cards = array();

        $this->createHandAndDeck($lineOfCards);
    }
 
    private function createHandAndDeck($lineOfCards) {
        $cardsInfo = explode(' ', $lineOfCards);
        
        $this->validate($cardsInfo);
        
        foreach($cardsInfo as $key => $cardInfo) {
            $card = new Card($cardInfo);
            $this->cards[] = $card;

            if ($key < 5) {
                $this->hand->addCard($card);
            } else {
                $this->deck->addCard($card);
            }
        }
    }

    private function validate($cardsInfo) {
        if(count($cardsInfo) != 10) {
            throw new \UnexpectedValueException('Invalid Cards Definition');
        }
    }

    public function getBestHand() {
		// initialize best value
        $this->bestValue = highest_card;
        
        // get all the possible combinations for the removal of the cards from hand
        $combinations = $this->getAllPossibleCardCombinations();

        //  for each possible number of cards removed from hand
        for($cardsRemoved = 0; $cardsRemoved <= 5; $cardsRemoved++) {
    		// choose "5 - $cardsRemoved" cards from first 5 cards (0-4) 
            // and ($cardsRemoved) cards in order from second 5 cards (5-9)
    		foreach($combinations[$cardsRemoved] as $combination) {
    			$hand = new Hand();
    			
                // add cards to hand
                foreach($combination as $cardKey) {
    				$hand->addCard($this->cards[$cardKey]);
    			}
	    		
                // adds cards from deck
                for($deckCardIndex = 5; $deckCardIndex < 10 - $cardsRemoved; $deckCardIndex++) {
	    			$hand->addCard($this->cards[$deckCardIndex]);
                }

                // store the bestValue of the hand
	    		$value = $hand->getValue();
	    		if ($value < $this->bestValue) {
	    			$this->bestValue = $value;
                }
	    		if ($this->bestValue == straight_flush) {
	    			break;
                }
    		}    		
    	}

        return $this->getFinalAnswer();
    }

    private function getFinalAnswer() {
        $result = array(
            straight_flush  => 'straight-flush',
            four_of_a_kind  => 'four-of-a-kind',
            full_house      => 'full-house',
            flush           => 'flush',
            straight        => 'straight',
            three_of_a_kind => 'three-of-a-kind',
            two_pairs       => 'two-pairs',
            one_pair        => 'one-pair',
            highest_card    => 'highest-card'
        );

        return 'Hand: ' . $this->hand . ' Deck: ' . $this->deck . ' Best hand: '.$result[$this->bestValue];
    }

    private function getAllPossibleCardCombinations() {
        $combinations = array();
        // We need to start with one empty element, we add or not add one element from data array each time
        $result = array(array());

        // Creates the cartesian product of all possible card combinations
        foreach (range(0,4) as $item) {
            $new_result = array();
            foreach ($result as $old_element) { 
                $new_result[] = array_merge($old_element, array($item));
                $new_result[] = array_merge($old_element, array('void'));
            }
            $result = $new_result;
        }

        // put all combinations of same size in separate arrays and removes the 'voids'
        foreach($result as $arr) {
            //  removing 'void' values
            $arr = array_diff($arr, array('void'));
            //  adding each array of items to the list of arrays of same length
            $combinations[count($arr)][] = $arr;
        }

        return $combinations;
    }
}