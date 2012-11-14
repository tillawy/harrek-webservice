<?php

//define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/Classes/Letter.php'); 
require_once(__ROOT__.'/Classes/Vocabulary.php'); 


class PuzzleDifficulty {
	const FLASH = 1;
	const EASY = 2;
	const MEDIUM = 3;
	const HARD = 4;
	const ADVANCED = 5;
}

class Puzzle {
	
	private $string = "";
	private $difficulty = PuzzleDifficulty::ADVANCED;
	private $vocabulary;


	static function PuzzleWithFile($_file){
		$str = file_get_contents($_file, true);
		$p = new Puzzle($str);
		return $p;
	}

	public function __construct($_str = "") {
		$this->string = $_str;
		$this->vocabulary = new Vocabulary();
		$this->vocabulary->parseLetters($_str);
	}

	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}
		if (property_exists($this->vocabulary, $property)) {
			return $this->vocabulary->$property;
		}
	}

	public function __set($property, $value) {
		if (property_exists($this, $property)) {
			$this->$property = $value;
		}
		return $this;
	}

	private function minimumCorrectContinousLetters(){
		switch ($this->difficulty) {
			case PuzzleDifficulty::FLASH :{
				return 10;
				break;
			}
			case PuzzleDifficulty::EASY :{
				return 8;
				break;
			}
			case PuzzleDifficulty::MEDIUM :{
				return 6;
				break;
			}
			case PuzzleDifficulty::HARD :{
				return 4;
				break;
			}	
			case PuzzleDifficulty::ADVANCED :{
				return 2;
				break;
			}
		}
	}

	private $lastRandom = 0;
	public function getLetterAtIndex($_i){
		$l = $this->vocabulary->sentence[$_i];
		if ( $l->isOrphan() ){
			// nothing here
		} elseif ( $this->lastRandom < $this->minimumCorrectContinousLetters()) {
			$this->lastRandom ++;
		} else {
			$this->lastRandom = 0;
			$l->isRandomizeable = TRUE;
		}
		return $l;
	}
	
}

?>
