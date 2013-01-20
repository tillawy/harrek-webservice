<?php


class LetterPosition {
	
	const ISOLATED = 0;
	const INITIAL = 1;
	const MEDIAL = 2;
	const LAST = 3;
}

#import 
class Letter extends JSONObject{
	private $Id;
	private $isolated;
	private $medial;
	private $initial;
	private $last;
	private $familyId;
	private $rootId;
	private $root;
	private $name;
	private $nextShouldBeInitial = FALSE;
 
	private $position ;
	private $isRandomizeable = FALSE;

	public static $families = array();

	function __construct(SimpleXMLElement $obj) {
		$this->isolated =  $obj->ContextualForms->Isolated;
		$this->last =  $obj->ContextualForms->Last;
		$this->medial =  $obj->ContextualForms->Medial;
		$this->initial =  $obj->ContextualForms->Initial;

		if ($obj->NextShouldBeInitial && $obj->NextShouldBeInitial  == 1) {
			$this->nextShouldBeInitial = TRUE;
		}

		if ($obj->Id) {
				  $this->Id = $this->getTextContent($obj->Id);
		}
		if ($obj->RootId) {
				  $this->rootId = $this->getTextContent($obj->RootId );
		}
		$this->name = $obj->Name;

		if ($obj->FamilyId) {
			$this->familyId = $this->getTextContent( $obj->FamilyId );

			if ( ! array_key_exists("f:" . $this->familyId , Letter::$families) ){
				Letter::$families["f:" . $this->familyId] = array();
			}

			array_push( Letter::$families["f:" . $this->familyId] , $this);
		}
	
	}

	private function getTextContent(SimpleXMLElement $_sxml){
			  return dom_import_simplexml($_sxml)->textContent;
	}

	public function matches( $_t = ""){
		return strcmp($this->isolated, $_t) == 0;
	}

	public function matchesLetter(Letter $_letter){
		return strcmp($this->isolated, $_letter->isolated) == 0;
	}

	public function isSpace(){
		return $this->matches("|");
	}

	public function isLineBreak(){
		return $this->matches("-");
	}

	public function stringPresentationForPosition( $position = 0){
		switch ($position) {
			case LetterPosition::ISOLATED:{
				return $this->isolated;
				break;
			}
			case LetterPosition::INITIAL:{
				return $this->initial;
				break;
			}
			case LetterPosition::LAST :{
				return $this->last;
				break;	
			}

			case LetterPosition::MEDIAL :{
				return $this->medial;   
				break;	
			}
			default:{
					  die("unknown position");
			}
		}
	}

	public function stringPresentation(){
		return $this->stringPresentationForPosition ($this->position);
	}

	public function isOrphan(){
		return count($this->getFamily()) == 1;
	}

	public function positionInFamily(){
		foreach ($this->getFamily() as $_key => $_letter) {
			if ($this == $_letter) {
				return $_key;
			}
		}
	}

	public function getFamily(){
		$arr = Letter::$families["f:" . $this->familyId];
		foreach ($arr as $l){
				  $l->position = $this->position;
		}
		return $arr;
	}

	public function getRandomFamilyMember(){
		if ( isset($this->familyId) ) {
			$aLetter = $this->getFamily()[ array_rand($this->getFamily()) ];
			$aLetter->position = $this->position;
			return $aLetter;;
		}
		return $this;	
	}

	public function jsonData(){
			  return array( "l" => $this->Id );
	}

	/*public function family(){
			return  Letter::$families["f:" . $this->familyId];
	}*/

	public function __set($property, $value) {
		if (property_exists($this, $property)) {
			$this->$property = $value;
		}  else {
		   die ("property:" . $property . " does not exist");
		}
		return $this;
	}


	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}  else {
		   die ("property:" . $property . " does not exist");
		}
	}

}



?>
