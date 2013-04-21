<?php

class HandTest extends \PHPUnit_Framework_TestCase {

	public function testGetValueForHighestCard() {
		$hand = $this->getHandFromLine('3D 5S 2H QD TD');
		$this->assertEquals(highest_card, $hand->getValue());
	}

	public function testGetValueForOnePair() {
		$hand = $this->getHandFromLine('TH JH QC QD AD');
		$this->assertEquals(one_pair, $hand->getValue());
	}

	public function testGetValueForTwoPairs() {
		$hand = $this->getHandFromLine('AH 2C 9S AD 9C');
		$this->assertEquals(two_pairs, $hand->getValue());
	}

	public function testGetValueForThreeOfAKind() {
		$hand = $this->getHandFromLine('AH AC 3S AD 9C');
		$this->assertEquals(three_of_a_kind, $hand->getValue());
	}

	public function testGetValueForStraight() {
		$hand = $this->getHandFromLine('5S 6H 2H 3C 4H');
		$this->assertEquals(straight, $hand->getValue());
	}

	public function testGetValueForStraightWithanAce() {
		$hand = $this->getHandFromLine('TS JH QH KC AH');
		$this->assertEquals(straight, $hand->getValue());
	}

	public function testGetValueForFlush() {
		$hand = $this->getHandFromLine('2H 5H 3H AH 9H');
		$this->assertEquals(flush, $hand->getValue());
	}

	public function testGetValueForFullHouse() {
		$hand = $this->getHandFromLine('2H 2S 3H 3S 3C');
		$this->assertEquals(full_house, $hand->getValue());
	}

	public function testGetValueForFourOfAKind() {
		$hand = $this->getHandFromLine('2H 3D 3H 3S 3C');
		$this->assertEquals(four_of_a_kind, $hand->getValue());
	}

	public function testGetValueForFourStraightFlush() {
		$hand = $this->getHandFromLine('2H 3H 4H 5H 6H');
		$this->assertEquals(straight_flush, $hand->getValue());
	}

	private function getHandFromLine($line) {
		$cards = explode(' ', $line);
		
		$card1 = new Card($cards[0]);
		$card2 = new Card($cards[1]);
		$card3 = new Card($cards[2]);
		$card4 = new Card($cards[3]);
		$card5 = new Card($cards[4]);

		$hand = new Hand();
		$hand->addCard($card1);
		$hand->addCard($card2);
		$hand->addCard($card3);
		$hand->addCard($card4);
		$hand->addCard($card5);

		return $hand;
	}

	public function testValidHand() {
		try {
			$cards = explode(' ', '3D 5S 2H QD');
		
			$card1 = new Card($cards[0]);
			$card2 = new Card($cards[1]);
			$card3 = new Card($cards[2]);
			$card4 = new Card($cards[3]);

			$hand = new Hand();
			$hand->addCard($card1);
			$hand->addCard($card2);
			$hand->addCard($card3);
			$hand->addCard($card4);

			$this->assertEquals(highest_card, $hand->getValue());
			$this->fail('Should hawe thrown exception');
		} catch (Exception $e) {
			$this->assertEquals("There should be 5 cards in a hand to evaluate", $e->getMessage());
		}
	}
}