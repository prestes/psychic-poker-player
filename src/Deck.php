<?php

class Deck {
	public $cards;
	
	function __construct () {
		$this->cards = array();
	}
	
	public function addCard (Card $card) {
		array_push($this->cards, $card);
	}

    public function __toString() {
        $response = array();
        foreach($this->cards as $card) {
            $response[] = (string) $card;
        }
        return implode(' ', $response);
    }
}