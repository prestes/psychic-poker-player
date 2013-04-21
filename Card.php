<?php
/* 
 * A card to hold the suit and number
 */
class Card {

	private $value;
	private $suit;
	private $cardInfo;

	public function __construct($cardInfo) {
		$this->validate($cardInfo);
		$this->populate($cardInfo);
	}

	public function getSuit() {
		return $this->suit;
	}

	public function getValue() {
		return $this->value;
	}

	public function __toString() {
		return $this->cardInfo;
	}

	private function validate($cardInfo) {
		if (strlen($cardInfo) != 2) {
			throw new \UnexpectedValueException('Invalid Card Definition');
		}
	}

	private function populate($cardInfo) {
		$value = $cardInfo[0];
		$suit = $cardInfo[1];
		
		$this->setValue($value);
		$this->setSuit($suit);
		$this->cardInfo = $cardInfo;
	}

	private function setValue($value) {
		if ($value >= 2 && $value <= 9) {
			$this->value = $value;
		} else {
			switch ($value) {
				case 'A':
					$this->value = 1;
					break;
				case 'T':
					$this->value = 10;
					break;
				case 'J':
					$this->value = 11;
					break;
				case 'Q':
					$this->value = 12;
					break;
				case 'K':
					$this->value = 13;
					break;
				default:
					throw new \UnexpectedValueException('Invalid Card Definition');
			}
		}
	}

	private function setSuit($suit) {
		switch ($suit) {
			case 'C':
				$this->suit = 0;
				break;
			case 'D':
				$this->suit = 1;
				break;
			case 'H':
				$this->suit = 2;
				break;
			case 'S':
				$this->suit = 3;
				break;
			default:
				throw new \UnexpectedValueException('Invalid Card Definition');
		}
	}
}