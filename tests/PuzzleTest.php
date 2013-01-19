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
					 $this->assertEquals( count($this->puzzle->sentence) , 37  );
		  }

		  public function testPuzzleNumberOfWords(){
					 $this->assertEquals( count($this->puzzle->words) , 10  );
		  }

}


?>
