<?php
require_once __DIR__ . '/Deck.php';

class Hand extends Deck {
	public $cards;
	
	function __construct () {
		$this->cards = array();
	}

	public function getValue() {
		// validates
		if (count($this->cards) != 5) {
			throw new \UnexpectedValueException('There should be 5 cards in a hand to evaluate');
		}

		// populate arrays of suits and values and their counts
		foreach ($this->cards as $card) {
			if (!isset($suits[$card->getSuit()])) {
				$suits[$card->getSuit()] = 0;
			}

			$suits[$card->getSuit()]++;
			
			if (!isset($values[$card->getValue()])) {
				$values[$card->getValue()] = 0;
			}
			$values[$card->getValue()]++;
		}

		// flush happened if there is only one suit in the hand
		if (count($suits) == 1) {
			$flush = true;
		}

		ksort($values);
		foreach ($values as $value => $sameValueCount) {
			
			if ($sameValueCount == 4) {
				$fourkind = true;
			}
			
			if ($sameValueCount == 3) {
				$threekind = true;
			}
			
			if ($sameValueCount == 2) {
				if (isset($pair) && $pair) {
					$twopair = true;
				} else {
					$pair = true;
				}
			}
			
			// lookup for sequences only if there is no repetition of values
			if (count($values) == 5) {
				if (!isset($previous_value)) {
					// condition for first loop
					$previous_value = $value;
				} elseif ($previous_value > 0) {
					if ($value == $previous_value + 1) {
						// evaluates the normal sequence
						$previous_value = $value;
					} elseif ($value == 10 && $previous_value == 1) {
						// evaluates the A T J Q K sequence
						$previous_value = $value;
					} else {
						// there's no sequence at all
						$previous_value = -100;
					}
				}
			}
		}
		
		// Now just return the hand value based on the previous evaluations

		if (isset($previous_value) && $previous_value > 0) {
			$straight = true;
			if (isset($flush) && $flush) {
				return straight_flush;
			}
		}
        
        if  (isset($fourkind) && $fourkind) {
            return four_of_a_kind;
        }
		
		if (isset($threekind) && $threekind && isset($pair) && $pair) {
            return full_house;
		}
        
        if (isset($flush) && $flush) {
            return flush;
        }
        
        if (isset($straight) && $straight) {
            return straight;
        }
		
		if (isset($threekind) && $threekind) {
            return three_of_a_kind;
		}
		
		if (isset($twopair) && $twopair)  {
            return two_pairs;
		}
		
		if (isset($pair) && $pair) {
            return one_pair;
		}
        
        return highest_card;
	}
}