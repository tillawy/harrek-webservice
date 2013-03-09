<?php
require_once('require.php'); 

header('Content-Type: application/json; charset=utf-8');
require_once('./nocache.php'); 

$vocabulary = new Vocabulary("letters3.xml");
echo json_encode( $vocabulary->json() );

?>
