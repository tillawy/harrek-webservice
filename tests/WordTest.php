<?php

require_once( "require.php" ) ; 

require_once "PHPUnit/Autoload.php";

class WordTest extends PHPUnit_Framework_TestCase
{


		 private $puzzle;

		 protected function setUp(){
					 $this->str = file_get_contents("b.txt", true); ;
					$this->puzzle = Puzzle::PuzzleWithStr( $this->str );
		  }


		  public function testPuzzleNumberOfWords(){
					 $this->assertEquals( count($this->puzzle->words) , 10  );
		  }

		  public function testWordsNumberOfLetters(){
					 $this->assertEquals( count($this->puzzle->words[0]->letters ) , 4  );
					 $this->assertEquals( count($this->puzzle->words[1]->letters ) , 3  );
		  }



		  public function testLetterPositions(){
					 $t = "محمد";
					 $letters =  WordsFactory::mb_str_split ( $t );
					 $word = new Word( $letters );
					 $this->assertEquals( $word->getLetterAtIndex(0)->position , LetterPosition::INITIAL  , "position should be INITIAL" );
					 $this->assertEquals( $word->getLetterAtIndex(1)->position , LetterPosition::MEDIAL  , "position should be MEDIAL" );
					 $this->assertEquals( $word->getLetterAtIndex( sizeof( $letters  ) - 1 )->position , LetterPosition::LAST  , "position should be LAST" );

		  }

		  public function testLetterNextShouldBeInitial(){
					 $t = "غادرششض";
					 $letters =  WordsFactory::mb_str_split ( $t );
					 $word = new Word( $letters );

					 $this->assertFalse( $word->getLetterAtIndex( 0 )->nextShouldBeInitial , "next should be initial" );
					 $this->assertTrue( $word->getLetterAtIndex( 1 )->nextShouldBeInitial , "next should be initial" );
					 $this->assertTrue( $word->getLetterAtIndex( 2 )->nextShouldBeInitial , "next should be initial" );
					 $this->assertTrue( $word->getLetterAtIndex( 3 )->nextShouldBeInitial , "next should be initial" );

					 $this->assertEquals( $word->getLetterAtIndex(0)->position , LetterPosition::INITIAL  , "position should be initial" );
					 $this->assertEquals( $word->getLetterAtIndex(1)->position , LetterPosition::MEDIAL  , "position should be medial" );
					 $this->assertEquals( $word->getLetterAtIndex(2)->position , LetterPosition::INITIAL  , "position should be initial" );
					 $this->assertEquals( $word->getLetterAtIndex(3)->position , LetterPosition::INITIAL  , "position should be initial" );
					 $this->assertEquals( $word->getLetterAtIndex(4)->position , LetterPosition::INITIAL  , "position should be initial" );
					 $this->assertEquals( $word->getLetterAtIndex(5)->position , LetterPosition::MEDIAL  , "position should be medial" );
					 $this->assertEquals( $word->getLetterAtIndex(6)->position , LetterPosition::LAST  , "position should be last" );
		  }


		  public function testLetterNextShouldBeInitialButIsolated(){
					 $t = "متردم";
					 $letters =  WordsFactory::mb_str_split ( $t );
					 $word = new Word( $letters );

					 $this->assertFalse( $word->getLetterAtIndex( 0 )->nextShouldBeInitial , "next should be initial" );
					 $this->assertFalse( $word->getLetterAtIndex( 1 )->nextShouldBeInitial , "next should be initial" );
					 $this->assertTrue( $word->getLetterAtIndex( 2 )->nextShouldBeInitial , "next should be initial" );
					 $this->assertTrue( $word->getLetterAtIndex( 3 )->nextShouldBeInitial , "next should be initial" );

					 $this->assertEquals( $word->getLetterAtIndex(0)->position , LetterPosition::INITIAL  , "position should be initial" );
					 $this->assertEquals( $word->getLetterAtIndex(1)->position , LetterPosition::MEDIAL  , "position should be medial" );
					 $this->assertEquals( $word->getLetterAtIndex(2)->position , LetterPosition::MEDIAL  , "position should be initial" );
					 $this->assertEquals( $word->getLetterAtIndex(3)->position , LetterPosition::INITIAL  , "position should be initial" );
					 $this->assertEquals( $word->getLetterAtIndex(4)->position , LetterPosition::ISOLATED  , "position should be initial" );
		  }
}


?>
