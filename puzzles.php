<?php

require_once('./require.php');
require_once('./nocache.php'); 

header('Content-Type: application/json; charset=utf-8');


$dir    = '/Users/mohammed/Sites/letters/Puzzles/';

$files1 = scandir($dir);
$exclude_list = array(".", "..", "example.txt");
$files2 = array_diff( $files1 , $exclude_list);
//print_r( $files2 );
$entries = [];

foreach ( $files2 as $file ){
		  if (preg_match ("/^[0-9]*\.txt/",$file) ){
					 $entries []= [ "id" =>  preg_replace( "/\..*$/" , "" , $file ) ];
		  }
}

echo( json_encode($entries) );


?>
