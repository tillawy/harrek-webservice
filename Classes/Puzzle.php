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
	
	//private $string = "";
	private $difficulty = PuzzleDifficulty::ADVANCED;
	private $vocabulary;
	private $sentence;	// an array of all letters
	private $words; 		// an array of all words


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
	   	$this->sentence = [];
			$this->words = [];
	   	$strLetters = Vocabulary::mb_str_split($_str);
			$aWord = new Word();
	   	foreach ($strLetters as $k => $val) {
	   		foreach ($this->vocabulary->languageLetters as $_index => $letter) {
	   			if ($letter->matches($val)) {
						if ($letter->isSpace() ){
								  $aWord->order = count( $this->words );
								  array_push ($this->words, $aWord);
								  $aWord = new Word();
						} else {
								  $aWord->addLetter($letter);
						}
						if ($k == count( $strLetters ) - 1 ){
								  $aWord->order = count( $this->words );
								  array_push ($this->words, $aWord);
						}
	   				array_push($this->sentence, $letter );
	   				break;
	   			}
	   		}
	   	}
			$this->resetLettersPositions();
			//$this->inspectWords();
	}

	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}  else {
		   die ("property:" . $property . " does not exist");
		}
	}

	public function __set($property, $value) {
		if (property_exists($this, $property)) {
			$this->$property = $value;
		}  else {
		   die ("property:" . $property . " does not exist");
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
		$l = $this->sentence[$_i];
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
	


   function resetLettersPositions(){
   	for ($i=0; $i < sizeof($this->sentence); $i++) { 
   		$this->resetLetterPositionAtIndex($i);
   	}
   }

   private function resetLetterPositionAtIndex($_i = 0){
   	//print ($_i . " " . $this->sentence[$_i]->initial . " " . count ($this->languageLetters));
   	$letter = $this->sentence[$_i];

   	if ( $_i ==  0 ) {
   		$letter->position = LetterPosition::INITIAL;
   		return;
   	}
   	if ( $_i > 0 ) {
   		if ( $this->sentence[$_i-1]->nextShouldBeInitial ) {
   			$letter->position = LetterPosition::INITIAL;
   			return;
   		}
   	}
   	if ($_i == sizeof($this->sentence) - 1 ) {
   		$letter->position = LetterPosition::LAST;
   		return;
   	}
   	if ( $this->sentence[$_i+1]->isSpace()) {
   		$letter->position = LetterPosition::LAST;
   		return;
   	}
   	$letter->position = LetterPosition::MEDIAL;
   	return;
   }

	function inspectWords(){
			$str = ""; 
			$str .= ( count( $this->words ) ); 
			foreach ( $this->words as $_word ){
					 $str .= "<br>";
					$str .= ( count($_word->letters) . " " . $_word->getPrint()  .  " " . $_word->order ); 
			}
			return $str;
	}

  
}

?>
