<?php

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/Classes/Letter.php'); 


class Vocabulary{

	private $letters;

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
   


   static function mb_str_split( $_string = "" ) {
    # Split at all position not after the start: ^
    # and not before the end: $
   		return preg_split('/(?<!^)(?!$)/u', $_string );
   }

}

?>
