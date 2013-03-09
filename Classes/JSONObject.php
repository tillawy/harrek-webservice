<?php


abstract class JSONObject {
		  protected $order;

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


		  public function jsonData(Puzzle $puzzle){
					 return [ "o" => $this->order, "s" => $this->getPrint() ];
		  }

}

?>
