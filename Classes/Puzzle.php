<?php

//define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/Classes/Letter.php'); 


class Puzzle {
	
	private $string = "";
	private $difficulty = 0;

	static function PuzzleWithFile($_file){
		$str = file_get_contents($_file, true);
		$p = new Puzzle();
		$p->setString($str);
		return $p;
	}

	public function __construct($str = "") {

	}



}

?>