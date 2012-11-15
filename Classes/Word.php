<?php


class Word extends JSONObject{
		  private $order;
		  private $letters = [];

		  public function __construct(){
					 $this->letters = [];
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
		  public function addLetter(Letter $_l){
					 array_push ($this->letters, $_l);
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
								array_push ( $jsonLetters, $_letter->jsonData() );
					 };
        
					 array_walk($this->letters, $callback);
					 $out = array ( "w" => $jsonLetters );
					 return $out;
		  }


}




?>
