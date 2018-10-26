<?php

require_once( "require.php" ) ;

use PHPUnit\Framework\TestCase;

class  WordsFactoryTest extends TestCase {


		  private $testString = "";
		  private $vocabulary;
		  protected function setUp(){
					 $this->testString = "محمد\tعمر\tالتلاوي\t\n اهلا و سهلا \n مع السلامة \n";
					 $this->vocabulary = new Vocabulary("letters3.xml");
		  }

		  public function  testTokenize(){
					 $t = WordsFactory::str_replace_space($this->testString);
					 $this->assertEquals( "محمد,+,عمر,+,التلاوي,+,,-,,اهلا,و,سهلا,,-,,مع,السلامة,,-," , $t , "spaces not removed" );
					 $t = WordsFactory::removeDoubleSpace( $t );
					 $this->assertEquals( preg_match( "/,,/", $t ) , 0 , "double spaces not removed");
					 print($t);
		  }

		  public function testSplitByCommand(){
					 WordsFactory::setVocabulary($this->vocabulary);
					 $s = WordsFactory::tokenize($this->testString);

					 list ($all, $words, $letters ) = WordsFactory::str_split_to_words( $s );
                     echo WordsFactory::inspectWords($words);
                     $this->assertCount(8, $words);
                     $this->assertCount(14, $all);
                     $this->assertCount(32, $letters);
		  }


}
