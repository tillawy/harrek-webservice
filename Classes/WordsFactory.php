<?php

class WordsFactory {

		  private static $vocabulary;
		  static public function  setVocabulary(Vocabulary $_v){
					 WordsFactory::$vocabulary = $_v;
		  }


		  /*
		  public  function str_replace_breaks(){
					 // first handle line break
					 $_string  = str_replace(array("\t"), '+', $_string);
					 $_string  = str_replace(array("\r", "\r\n", "\n"), '-', $_string);
					 $_string  = str_replace(array(" "), '|', $_string);
					 return $_string;
		  }*/

		  static function mb_str_split( $_string = "" ) {
					 # Split at all position not after the start: ^
					 # and not before the end: $
					 return preg_split('/(?<!^)(?!$)/u', $_string );
		  }

		  static function removeDoubleSpace($_string){
					 return preg_replace('/,{2,}/',',', $_string );
		  }

		  static function str_split_to_words( $_string = "" ) {
					 //return explode ("," , $_string);
					 //$arr = preg_split("/\+|-/" , $_string);
					 
					 $arr = preg_split("/,/u" , $_string);
					 $words = array();
					 $letters = array();
					 $all = array();
					 //print_r ( $arr );
					 $randomizeCounter = 0;
					 foreach ($arr as $_i => $_v){
								$obj = null;
								if ($_v == "+"){
										  //echo "tab\n";
										//array_push( $words , new TabBreak() );
										  $obj = new TabBreak();
								} else if ($_v == "-" ){
										//array_push( $words , new LineBreak() );
										  $obj = new LineBreak();
										  //echo "break";
								} else if (strlen(trim($_v)) == 0){
										  //echo "space\n";
										  continue;
								} else {
										  $wordLetters = self::mb_str_split ( $_v );
										  $word = new Word(  $wordLetters );
										  foreach ($wordLetters as $_iv => $_lv){
													 //echo $_iv . " $_lv" . "\n";
													 $letter = self::getLetterFor($_lv);
													 $letter->indexInWord = $_iv;
													 $letter->wordIndex =  $_i;
													 $letter->indexInPuzzle = sizeof( $letters );
													 if ( $letter->isOrphan() == FALSE ){
																//echo $randomizeCounter . " " ;
																$letter->indexRandomize = $randomizeCounter++;
													 } else {
																$letter->indexRandomize = $randomizeCounter;
													 }
													 //echo "- " .  $letter->isolated . " " . $randomizeCounter . " " .  $letter->indexRandomize . " \n" ;
													 $letters []=  $letter;
													 $word->addLetter($letter);
										  }
										  $word->order = $_i;
										  $words []= $word;
										  $obj = $word;
								}
								$all []= $obj;
					 }

					 return array ($all, $words, $letters );
		  }


		  public static function getLetterFor($_l = ""){
					 return self::$vocabulary->getLetterFor($_l);
		  }

		  static function str_replace_space( $_string = "" ) {
					 // first handle line break
					 $_string  = str_replace(array("\t"), ',+,', $_string);
					 $_string  = str_replace(array("\r", "\r\n", "\n"), ',-,', $_string);
					 //print ( "'" . $_string . "'<br/>\n" );
					 //$_string  = str_replace(array(" "), ',', $_string);
					 $_string  = preg_replace("/\s+/u", ',', $_string);
					 //print ( "'" . $_string . "'<br/>\n" );
					 return  $_string;
		  }

		  static function tokenize($_string){
					 $t = WordsFactory::str_replace_space($_string);
					 $t = WordsFactory::removeDoubleSpace( $t );
					 return $t;
		  }

		  /*
		  static function parseWords($_string = ""){
					 $str = WordsFactory::str_replace_breaks($_string);
					 //$str = 

		  }*/

		  static function inspectWords( $words ){
					 $str = ""; 
					 $str .= ( count( $words ) ); 
					 foreach ( $words as $_word ){
								$str .= "<br>\n";
								//$str .= ( count($_word->letters) . " " . $_word->getPrint()  .  " " . $_word->order ); 
								$str .= (  $_word->getPrint()  .  " " . $_word->order ); 
					 }
					 return $str;
		  }

		  static function inspectLetters( $_letters ){
					 $str = ""; 
					 $str .= ( count( $_letters ) ) . " "; 
					 foreach ( $_letters as $_i => $_letter ){
								$str .= " $_i => ";
								$str .= (  $_letter->isolated ) . ","; 
					 }
					 return $str;
		  }

}



?>
