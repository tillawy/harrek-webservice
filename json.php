<?php

require_once('./require.php');

header('Content-Type: application/json; charset=utf-8');


$puzzle = Puzzle::PuzzleWithFile('./b.txt');
//$puzzle->difficulty = PuzzleDifficulty::ADVANCED;
$puzzle->difficulty = PuzzleDifficulty::FLASH;


echo json_encode ( $puzzle->json() );

?>
