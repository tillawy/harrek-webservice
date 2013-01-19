<?php

require_once('./require.php');

header('Content-Type: application/json; charset=utf-8');


$puzzle = Puzzle::PuzzleWithFile('./c.txt');
$puzzle->difficulty = PuzzleDifficulty::ADVANCED;

$arr = array();

if (array_key_exists("req-obj", $_GET) && $_GET['req-obj'] == "words" ){
		   $arr =  $puzzle->words;
} else {
		   $arr =  $puzzle->all;
}

$output = [];
foreach ( $arr as  $_obj ){
		  array_push( $output , $_obj->jsonData() );
}

echo json_encode ( array("words" =>  $output ) );

?>
