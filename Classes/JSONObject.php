<?php


abstract class JSONObject {
		  private $order;
		  abstract protected function jsonData(Puzzle $p);

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
}

?>
