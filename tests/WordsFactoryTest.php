<?php

require_once( "require.php" ) ; 

require_once "PHPUnit/Autoload.php";

class  WordsFactoryTest extends PHPUnit_Framework_TestCase {


		  private $testString = "";
		  private $vocabulary;
		  protected function setUp(){
					 $this->testString = "محمد\tعمر\tالتلاوي\t\n اهلا و سهلا  \n مع  السلامة  \n";
					 $this->vocabulary = new Vocabulary("letters3.xml");
		  }

		  public function  testTokenize(){
					 $t = WordsFactory::str_replace_space($this->testString);
					 $this->assertEquals($t ,  "محمد,+,عمر,+,التلاوي,+,-,,اهلا,و,سهلا,,-,,مع,,السلامة,,-," , "spaces not removed" );
					 $t = WordsFactory::removeDoubleSpace( $t );
					 $this->assertEquals( preg_match( "/,,/", $t ) , 0 , "double spaces not removed");
					 //print($t);
		  }

		  public function testSplitByCommand(){
					 WordsFactory::setVocabulary($this->vocabulary);
					 $s = WordsFactory::tokenize($this->testString);
					 //echo $s;
					 list ($all, $words, $letters ) = WordsFactory::str_split_to_words( $s );
					 echo WordsFactory::inspectWords($words);
					 //print ( count( $arr ) );
		  }


}
