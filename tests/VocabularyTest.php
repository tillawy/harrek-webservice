<?php

require_once( "require.php" ) ; 

require_once "PHPUnit/Autoload.php";

class VocabularyTest extends PHPUnit_Framework_TestCase
{

		 private $xml;
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
													<Last>ـىـ</Last>
													<Medial>ـىـ</Medial>
													<Initial>ىـ</Initial>
													<Isolated>ىـ</Isolated>
										 </ContextualForms>
										 <RootId>31</RootId>
										 <FamilyId>1</FamilyId>
							  </Letter>
					</Letters>";
	    }

		 public function testVocabularyXmlParsing() {
					$vocabulary = new Vocabulary();
					$this->assertTrue( $vocabulary->parseXmlString( $this->xml ) , "parse xml success" );
					$this->assertEquals( sizeof($vocabulary->languageLetters) , 2 , "no letters in xml" );
		 }
}




