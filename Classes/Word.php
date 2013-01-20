<?php


class Word extends JSONObject{

		  private $text;

		  private $order;
		  private $lastInLine = FALSE;
		  private $letters = [];

		  public function __construct(){
					 $this->letters = [];
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
		  public function addLetter(Letter $_l){
					 array_push ($this->letters, $_l);
		  }

		  public function getLetterAtIndex($_i){
					 $letter = $this->letters[$_i];
					 if ($_i == 0){
								$letter->position = LetterPosition::INITIAL;
					 } else if ($_i == sizeof( $this->letters ) - 1){
								$letter->position = LetterPosition::LAST;
								//echo $letter->stringPresentation() . " ";
								//echo $letter->position  . " ";
					 } else {
								$letter->position = LetterPosition::MEDIAL;
					 }
					 return $letter;
		  }

		  public function getPrint(){
					 $str = array();
					 foreach ( $this->letters as $_l){
							array_push ( $str,$_l->isolated );
					 }
					 return implode($str);
		  }
		  public function jsonData(){
					 $jsonLetters = array();
					 $callback = function ( $_letter ) use ( &$jsonLetters ) {
								//array_push ( $jsonLetters, $_letter->jsonData() );
								array_push ( $jsonLetters, $_letter->Id );
					 };
        
					 array_walk($this->letters, $callback);
					 $out = array ( "w" => $jsonLetters );
					 //if ( $this->lastInLine ) $out["br"]=  1;
					 return $out;
		  }


}




?>
