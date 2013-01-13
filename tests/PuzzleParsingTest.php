<?php

require_once( "require.php" ) ; 

require_once "PHPUnit/Autoload.php";

class PuzzleParsingTest extends PHPUnit_Framework_TestCase
{

		  protected $str;
		  protected function setUp(){
					 $str = "ابجد هوز حطي كلمن سعفص قرشت ثخ ض ذ ظغ";
		  }

		  public function testPuzzleCreation(){
					 $puzzle = Puzzle::PuzzleWithStr( $this->str );
					 $this->assertNotNull ( $puzzle );
		  }
}
?>
