<?php

require_once( "require.php" ) ; 

require_once "PHPUnit/Autoload.php";

class PuzzleTest extends PHPUnit_Framework_TestCase
{

		  private $str;
		  private $puzzle;

		  
		  protected function setUp(){
					 
					 $this->str = file_get_contents("b.txt", true); ;
					 $this->puzzle = Puzzle::PuzzleWithStr( $this->str );
		  }


		 
		  public function testPuzzleCreation(){
					 $this->assertNotNull ( $this->puzzle );
		  }

		  public function testPuzzleNumberOfLetters(){
					 //echo WordsFactory::inspectLetters( $this->puzzle->letters );
					 $this->assertEquals( count($this->puzzle->letters) , 28  );
		  }

		  public function testPuzzleNumberOfWords(){
					 $this->assertEquals( count($this->puzzle->words) , 10  );
		  }

		  public function testIsRandomizeable(){
					 //$anStr = "ااابجد هوز حطي كمان سعفص";
					 //$anStr = "ابجد ههههوز حطي كمان سعفص";
					 //$anStr = "ابجد هوز حطي كمان سعفص";
					 //$somePuzzle = Puzzle::PuzzleWithStr( $anStr );
					 $this->puzzle->difficulty = PuzzleDifficulty::HARD;

					 $l0 = $this->puzzle->letters[0];
					 $this->assertTrue( $this->puzzle->isLetterRandomizeable( $l0 ), "randomizeable 0");
					 
					 $l1 = $this->puzzle->letters[1];
					 $this->assertFalse( $this->puzzle->isLetterRandomizeable( $l1 ), "randomizeable 1");

					 $l2 = $this->puzzle->letters[2];
					 $this->assertFalse( $this->puzzle->isLetterRandomizeable( $l2 ), "randomizeable 2");

					 $l3 = $this->puzzle->letters[3];
					 $this->assertFalse( $this->puzzle->isLetterRandomizeable( $l3 ), "randomizeable 3");

					 $l4 = $this->puzzle->letters[4];
					 $this->assertTrue( $this->puzzle->isLetterRandomizeable( $l4 ), "randomizeable 4");
		  }

}


?>
