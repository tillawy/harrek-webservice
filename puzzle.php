<?php

require_once('./require.php');
require_once('./nocache.php'); 

header('Content-Type: application/json; charset=utf-8');


$puzzle = Puzzle::PuzzleWithFile('./Puzzles/' . $_REQUEST['puzzle_id'] . '.txt');
if (array_key_exists("h",$_REQUEST)){
		  switch ($_REQUEST['h']){
		  case 4:
					 $puzzle->difficulty = PuzzleDifficulty::ADVANCED;
					 break;
		  case 3:
					 $puzzle->difficulty = PuzzleDifficulty::MEDIUM;
					 break;
		  case 2:
					 $puzzle->difficulty = PuzzleDifficulty::HARD;
					 break;
		  case 1:
					 $puzzle->difficulty = PuzzleDifficulty::EASY;
					 break;
		  default:
					 $puzzle->difficulty = PuzzleDifficulty::FLASH;
					 break;
		  }
}


echo json_encode ( $puzzle->json() );

?>
