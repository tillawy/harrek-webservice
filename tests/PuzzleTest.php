<?php

require_once( "require.php" ) ; 

require_once "PHPUnit/Autoload.php";

class PuzzleParsingTest extends PHPUnit_Framework_TestCase
{

		  private $str;
		  private $puzzle;

		  protected function setUp(){
					 $this->str = "ابجد هوز حطي كلمن سعفص قرشت ثخ ض ذ ظغ";
					 $this->puzzle = Puzzle::PuzzleWithStr( $this->str );
		  }

		  public function testPuzzleCreation(){
					 $this->assertNotNull ( $this->puzzle );
		  }
		  public function testPuzzleNumberOfWords(){
					 $this->assertEquals( count($this->puzzle->words) , 10 );
		  }
}
?>
