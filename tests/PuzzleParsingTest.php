<?php

require_once( "require.php" ) ;

use PHPUnit\Framework\TestCase;

class PuzzleParsingTest extends TestCase
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
