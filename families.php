<?php

require_once('./require.php');

require_once('./nocache.php'); 

header('Content-Type: application/json; charset=utf-8');

$puzzle = new Puzzle();
$out = [];
foreach  ( Letter::$families as $_k => $_f){
		  $letter =  $_f[0];
		  $out[] = [ "fId" =>  $letter->familyId ,
					 "ids" => array_values ( $letter->getFamilyIds() ) ];
}

echo json_encode ( $out );

?>
