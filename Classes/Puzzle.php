<?php

//define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/require.php'); 


class PuzzleDifficulty {
	const FLASH = 1;
	const EASY = 2;
	const MEDIUM = 3;
	const HARD = 4;
	const ADVANCED = 5;
}


class Puzzle {
	
	//private $string = "";
	private $difficulty = PuzzleDifficulty::ADVANCED;
	private $vocabulary;
	private $letters;	// an array of all letters
	private $words; 		// an array of all words
	private $all; 		// an array of all words and breaks


	static function PuzzleWithFile($_file){
			  $str = file_get_contents($_file, true);
			  return Puzzle::PuzzleWithStr($str);
	}

	static function PuzzleWithStr($_str){
			  $p = new Puzzle($_str);
			  return $p;
	}

	public function __construct($_str = "") {
		//$this->string = $_str;
		$this->vocabulary = new Vocabulary("letters3.xml");
		$this->parseLetters($_str);
	}


   public function parseLetters($_str = ""){
			  WordsFactory::setVocabulary($this->vocabulary);
			  $s = WordsFactory::tokenize($_str );
			  //echo $s;
			  list ( $this->all,  $this->words , $this->letters ) = WordsFactory::str_split_to_words( $s );
			  //$this->resetLettersPositions(); // move to word

			  //print ( count( $arr ) );
			//$this->inspectWords();
	}

	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}  else {
		   die ("property: " . $property . " does not exist for:" .  get_class());
		}
	}

	public function __set($property, $value) {
		if (property_exists($this, $property)) {
			$this->$property = $value;
		}  else {
		   die ("property: " . $property . " does not exist for:" .  get_class());
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


	public function isLetterRandomizeable( Letter $letter ){
			  if ($letter->isOrphan()){
						 return false;
			  }

			  // TBD ...
			  // alif is not randomizeable // very irritating 
			  // should be handled from xml
			  if ($letter->familyId == 0 ){
						 return false;
			  }

			  $r =  $letter->indexRandomize % $this->minimumCorrectContinousLetters() == 0;
			  //echo "r: " . $r. " ,x: " . $letter->indexRandomize . " ,min: " . $this->minimumCorrectContinousLetters() . " ," ;
			  return $r;
	}
	
	public function json(){
			  $output = [];
			  foreach ( $this->all as $_wi => $_obj ){
						 $output []= $_obj->jsonData ($this);
			  }
				return $output;
	}


  
}

?>
