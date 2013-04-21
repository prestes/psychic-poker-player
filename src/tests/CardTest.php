<?php

class CardTest extends \PHPUnit_Framework_TestCase {

	public function testValidate() {
		try {
			new Card('a');
			$this->fail('should throw an error');
		} catch (\Exception $e) {
			$this->assertEquals('Invalid Card Definition', $e->getMessage());
		}
	}

	public function testCreateCard() {
		$card = new Card('2H');
		$this->assertEquals('2', $card->getSuit());
		$this->assertEquals('2', $card->getValue());

		$card = new Card('JC');
		$this->assertEquals('0', $card->getSuit());
		$this->assertEquals('11', $card->getValue());

		$card = new Card('QS');
		$this->assertEquals('3', $card->getSuit());
		$this->assertEquals('12', $card->getValue());

		$card = new Card('KD');
		$this->assertEquals('1', $card->getSuit());
		$this->assertEquals('13', $card->getValue());
	}

	public function testToString() {
		$card = new Card('3C');
		$this->assertEquals('3C', (string) $card);

		$card = new Card('KC');
		$this->assertEquals('KC', (string) $card);
	}
}