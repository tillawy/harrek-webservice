<?php


class LetterPosition {
	
	const INITIAL = 1;
	const MEDIAL = 2;
	const LAST = 3;
}

class Letter{
	private $Id;
	private $isolated;
	private $medial;
	private $initial;
	private $last;
	private $familyId;
	private $rootId;
	private $root;
	private $id;
	private $name;
	private $nextShouldBeInitial = FALSE;
 
	private $position ;


	public static $families = array();
	function __construct(SimpleXMLElement $obj) {
		$this->isolated =  $obj->ContextualForms->Isolated;
		$this->last =  $obj->ContextualForms->Last;
		$this->medial =  $obj->ContextualForms->Medial;
		$this->initial =  $obj->ContextualForms->Initial;

		if ($obj->NextShouldBeInitial) {
			$this->nextShouldBeInitial = TRUE;
		}

		$this->id = $obj->Id;
		$this->rootId = $obj->RootId;
		$this->name = $obj->Name;

		if ($obj->FamilyId) {
			$this->familyId = $obj->FamilyId;

			if ( ! array_key_exists("f:" . $this->familyId , Letter::$families) ){
				Letter::$families["f:" . $this->familyId] = array();
			}

			array_push( Letter::$families["f:" . $this->familyId] , $this);
		}
	
	}
	public function matches( $_t = ""){
		return strcmp($this->isolated, $_t) == 0;
	}

	public function isSpace(){
		return $this->matches(" ");
	}

	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}
	}

	public function __set($property, $value) {
		if (property_exists($this, $property)) {
			$this->$property = $value;
		}
		return $this;
	}

	public function stringPresentation(){
		switch ($this->position) {
			case LetterPosition::INITIAL:{
				return $this->initial;
				break;
			}
			case LetterPosition::LAST :{
				return $this->last;
				break;	
			}

			default:{
				return $this->medial;   
				break;	
			}
		}
	}

	public function getFamily(){
		return Letter::$families["f:" . $this->familyId];
	}

	public function getRandomFamilyMember(){
		if ( isset($this->familyId) ) {
			return $this->getFamily()[ array_rand($this->getFamily()) ];
		}
		return $this;	
	}

}



?>
