<?php

class GameTest extends \PHPUnit_Framework_TestCase{

	public function testGetBestHandForStraightFlush() {
		$game = new Game('TH JH QC QD QS QH KH AH 2S 6S');
		$this->assertEquals(
			'Hand: TH JH QC QD QS Deck: QH KH AH 2S 6S Best hand: straight-flush',
			$game->getBestHand()
		);
	}

	public function testGetBestHandForFourOfAKind() {
		$game = new Game('2H 2S 3H 3S 3C 2D 3D 6C 9C TH');
		$this->assertEquals(
			'Hand: 2H 2S 3H 3S 3C Deck: 2D 3D 6C 9C TH Best hand: four-of-a-kind',
			$game->getBestHand()
		);
	}

	public function testGetBestHandForFullHouse() {
		$game = new Game('2H 2S 3H 3S 3C 2D 9C 3D 6C TH');
		$this->assertEquals(
			'Hand: 2H 2S 3H 3S 3C Deck: 2D 9C 3D 6C TH Best hand: full-house',
			$game->getBestHand()
		);
	}

	public function testGetBestHandForFlush() {
		$game = new Game('2H AD 5H AC 7H AH 6H 9H 4H 3C');
		$this->assertEquals(
			'Hand: 2H AD 5H AC 7H Deck: AH 6H 9H 4H 3C Best hand: flush',
			$game->getBestHand()
		);
	}

	public function testGetBestHandForStraight() {
		$game = new Game('AC 2D 9C 3S KD 5S 4D KS AS 4C');
		$this->assertEquals(
			'Hand: AC 2D 9C 3S KD Deck: 5S 4D KS AS 4C Best hand: straight',
			$game->getBestHand()
		);
	}

	public function testGetBestHandForHighestCard() {
		$game = new Game('3D 5S 2H QD TD 6S KH 9H AD QH');
		$this->assertEquals(
			'Hand: 3D 5S 2H QD TD Deck: 6S KH 9H AD QH Best hand: highest-card',
			$game->getBestHand()
		);
	}
}