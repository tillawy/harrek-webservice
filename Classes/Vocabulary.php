<?php

require_once('require.php'); 


class Vocabulary{

	private $languageLetters;

	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}  else {
		   die ("property:" . $property . " does not exist");
		}
	}

	public function __construct($_xmlFile = null) {
      if ($_xmlFile) {
         $this->parseXmlFile($_xmlFile);
      }
   }
	public function __destruct(){
			  //echo "__destruct";
			  //foreach(Letter::$families as $_i => $_v){ unset (  Letter::$families[$_i] ); }
	}


   public function parseXmlFile($_xmlFile = null){
			  return $this->parseXmlString( file_get_contents($_xmlFile , true) );
	}


   public function parseXmlString($_xmlString = ""){
			  assert ( strlen($_xmlString) > 0 );
			  $xml = new SimpleXMLElement( $_xmlString );
			  return $this->parseXmlElement( $xml );
	}

   public function parseXmlElement(SimpleXMLElement $_xmlElement){
		$this->languageLetters = [];
		foreach ($_xmlElement->children() as $sxe) {
			$l = new Letter ($sxe);
			array_push($this->languageLetters, $l);
		}
		return true;
   }
   
	public function getLetterFor($_l = ""){
			  foreach ($this->languageLetters as $_index => $letter) {
						 if ($letter->matches($_l)) {
									return clone $letter;
						 }
			  }
			  die ("FATAL letter match not found for:'" . $_l . "'.\n");
	}

	public function json(){
			  $out = [];
			  foreach ($this->languageLetters as $_index => $_letter) {
						 $out []= [ 
									"id" => $_letter->Id,
									"in" => $_letter->initial,
									"is" => $_letter->isolated,
									"me" => $_letter->medial,
									"la" => $_letter->last,
									"fId" => $_letter->familyId,
									"fam" => $_letter->getFamilyIds()
									];
			  }
			  return $out;
	}

}

?>
