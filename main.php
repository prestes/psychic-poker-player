<?php
require_once 'src/bootstrap.php';

class Main {
	public static function run() {
		echo 'Type the line corresponding to the cards: ';
		while(true) {
		    $current_line = fgets(STDIN,1024);
		    $current_line = trim($current_line);
            //  read until reaching an empty line
		    if($current_line != '') {
		        $game = new Game($current_line);
		        printf($game->getBestHand() . PHP_EOL);
		        unset($game);
		    } else {
		        exit;
		    }
		}
	}
}

Main::run();