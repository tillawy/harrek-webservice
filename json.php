<?php

require_once('./Classes/JSONObject.php'); 
require_once('./Classes/Vocabulary.php'); 
require_once('./Classes/Letter.php'); 
require_once('./Classes/Puzzle.php');
require_once('./Classes/Word.php');

header('Content-Type: application/json; charset=utf-8');


$puzzle = Puzzle::PuzzleWithFile('./b.txt');
$puzzle->difficulty = PuzzleDifficulty::ADVANCED;

$words = array();
foreach ( $puzzle->words as $_wi => $_word ){
		  array_push( $words, $_word->jsonData() );
}
echo json_encode ( array("words" =>  $words ) );


?>
