<?php

require_once( "require.php" ) ; 

require_once "PHPUnit/Autoload.php";

class WordTest extends PHPUnit_Framework_TestCase
{


		 private $puzzle;

		 protected function setUp(){
					$this->str = "ابجد هوز حطي كلمن سعفص قرشت ثخ ض ذ ظغ";
					$this->puzzle = Puzzle::PuzzleWithStr( $this->str );
		  }


		  public function testPuzzleNumberOfWords(){
					 $this->assertEquals( count($this->puzzle->words) , 10  );
		  }

		  public function testWordsNumberOfLetters(){
					 $this->assertEquals( count($this->puzzle->words[0]->letters ) , 4  );
					 $this->assertEquals( count($this->puzzle->words[1]->letters ) , 3  );
		  }



}


?>
