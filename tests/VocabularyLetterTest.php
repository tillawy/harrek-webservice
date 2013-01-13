
<?php

require_once( "require.php" ) ; 

require_once "PHPUnit/Autoload.php";

class VocabularyLetterTest extends PHPUnit_Framework_TestCase
{

		 private $xml;
		 private $vocabulary;
		 protected function setUp(){
					$this->xml = "<Letters>
							  <Letter>
										 <Id>0</Id>
										 <Name>’alif</Name>
										 <Translit>’ / ā</Translit>
										 <Value>various, including /aː/ [a]</Value>
										 <ContextualForms>
													<Last>ـا</Last>
													<Medial>ـا</Medial>
													<Initial>ا</Initial>
													<Isolated>ا</Isolated>
										 </ContextualForms>
										 <RootId>0</RootId>
										 <FamilyId>0</FamilyId>
										 <NextShouldBeInitial>1</NextShouldBeInitial>
							  </Letter>
							  <Letter>
										 <Id>31</Id>
										 <Name>Korsi</Name>
										 <Translit></Translit>
										 <Value></Value>
										 <ContextualForms>
													<Last>l</Last>
													<Medial>m</Medial>
													<Initial>i</Initial>
													<Isolated>s</Isolated>
										 </ContextualForms>
										 <RootId>31</RootId>
										 <FamilyId>1</FamilyId>
							  </Letter>
					</Letters>";
					$this->vocabulary = new Vocabulary();
					$this->vocabulary->parseXmlString( $this->xml );
	    }



		 public function testLetter() {
			$letter = $this->vocabulary->languageLetters[1];

			$this->assertNotNull( $letter);
			$this->assertEquals( $letter->Id , 31);

			$this->assertNotNull(  $letter->isolated );
			$this->assertEquals( $letter->isolated , "s");

			$this->assertNotNull(  $letter->medial );
			$this->assertEquals( $letter->medial, "m");

			$this->assertNotNull(  $letter->initial );
			$this->assertEquals( $letter->initial , "i");

			$this->assertNotNull(  $letter->last );
			$this->assertEquals( $letter->last , "l");

			$this->assertNotNull( $letter->rootId  );
			$this->assertEquals( $letter->rootId , 31 );

			$this->assertNotNull( $letter->name );
			$this->assertEquals( $letter->name  , "Korsi" );

			$this->assertNotNull( $letter->familyId );
			$this->assertEquals( $letter->familyId  , 1);


			/*print( $s->ContextualForms->Isolated . "\t" .  $s->ContextualForms->Final . "\t" . $s->ContextualForms->Medial . "\t" . $s->ContextualForms->Initial . "\n");*/

		 }
}


