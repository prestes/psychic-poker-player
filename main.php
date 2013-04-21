<?php
require_once 'bootstrap.php';

class Main {
	public function run() {
		
		while(true) {
		    $current_line = fgets(STDIN,1024);
		    $current_line = trim($current_line);
            //  read until reaching an empty line
		    if($current_line != '') {
		        $game = new Game($current_line);
                //  assuming input is valid, otherwise php doesnt care anyway
		        printf("\r\n" . $game->getBestHand() . "\r\n");
		        unset($game);
		    } else {
		        exit;
		    }
		}
	}
}

Main::run();