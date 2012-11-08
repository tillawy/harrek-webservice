<?php

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/Classes/Letter.php'); 


class Vocabulary{

	private $letters;
	private $sentence;
	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}
	}

	public function __construct() {
		$xml = new SimpleXMLElement( $str = file_get_contents('letters3.xml' , true));
		$this->letters = [];
		foreach ($xml->children() as $sxe) {
			$l = new Letter ($sxe);
			array_push($this->letters, $l);
			/*print( $s->ContextualForms->Isolated
				. "\t" .  $s->ContextualForms->Final 
				. "\t" . $s->ContextualForms->Medial 
				. "\t" . $s->ContextualForms->Initial
				. "\n"
			);*/
		}
   }

   public function parse($_str = ""){
	   	$this->sentence = [];
	   	$strLetters = $this->mb_str_split($_str);
	   	foreach ($strLetters as $k => $val) {
	   		foreach ($this->letters as $key => $letter) {
	   			if ($letter->matches($val)) {
	   				array_push($this->sentence, $letter );
	   				break;
	   			}
	   		}
	   	}
	   $this->resetLettersPositions();
   }

   function resetLettersPositions(){
   	for ($i=0; $i < sizeof($this->sentence); $i++) { 
   		$this->resetLetterPositionAtIndex($i);
   	}
   }

   private function resetLetterPositionAtIndex($_i = 0){
   	//print ($_i . " " . $this->sentence[$_i]->initial . " " . count ($this->letters));
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