<?php

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/Classes/Letter.php'); 


class Vocabulary{

	private $letters;
	private $words;
	private $sentence;
	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}
	}

	public function __construct() {
		$xml = new SimpleXMLElement( $str = file_get_contents('letters3.xml' , true));
		$this->languageLetters = [];
		foreach ($xml->children() as $sxe) {
			$l = new Letter ($sxe);
			array_push($this->languageLetters, $l);
			/*print( $s->ContextualForms->Isolated
				. "\t" .  $s->ContextualForms->Final 
				. "\t" . $s->ContextualForms->Medial 
				. "\t" . $s->ContextualForms->Initial
				. "\n"
			);*/
		}
   }

   public function parseWords($_str = ""){
			  $i = 0;
			  foreach ($this->sentence as $_letter){
						 if ($_letter->isSpace()){
									$i++;

						 }
			  }
	}

   public function parseLetters($_str = ""){
	   	$this->sentence = [];
			$this->words = [];
	   	$strLetters = $this->mb_str_split($_str);
			$aWord = new Word();
	   	foreach ($strLetters as $k => $val) {
	   		foreach ($this->languageLetters as $_index => $letter) {
	   			if ($letter->matches($val)) {
						if ($letter->isSpace() ){
								  $aWord->order = count( $this->words );
								  array_push ($this->words, $aWord);
								  $aWord = new Word();
						} else {
								  //array_push($aWord->letters, $letter);
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
			$this->inspectWords();
   }
	function inspectWords(){
			print ( count( $this->words ) ); 
			foreach ( $this->words as $_word ){
					 print "<br>";
					 print ( count($_word->letters) . " " . $_word->getPrint()  .  " " . $_word->order ); 
			}
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

  


   function mb_str_split( $_string = "" ) {
    # Split at all position not after the start: ^
    # and not before the end: $
   		return preg_split('/(?<!^)(?!$)/u', $_string );
   }

}

?>
