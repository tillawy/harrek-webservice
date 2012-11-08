<?php

require_once('./Classes/Vocabulary.php'); 
require_once('./Classes/Letter.php'); 
require_once('./Classes/Puzzle.php'); 


header('Content-Type: text/html; charset=utf-8');

// <= PHP 5
$str = file_get_contents('./b.txt', true);
//echo $str;
//echo $file;




//$word = mb_str_split();
//print_r ($word);

$v = new Vocabulary();

$v->parse($str);




echo "<html>";
echo ' 
  <head>
					 <script src="http://127.0.0.1/~mohammed/letters/jquery-1.8.2.min.js"></script>
		  </head>';
		  echo "<body>";
echo '<div classs="arabic_letter" direction="rtl" dir="rtl" align="right">';



foreach ($v->sentence as $letter) {
	echo '<div class="letter">'
	//. $letter->stringPresentation() 
	. '</div>';
}

foreach ($v->sentence as $letter) {
	foreach ($letter->getFamily() as $fLetter ) {
		//echo $fLetter->stringPresentation();
	}
	echo '<div class="letter">'
	//. $letter->getRandomFamilyMember()->stringPresentation() 
	. '</div>';
}


foreach ($v->sentence as $letter) {
	echo '<div class="letter">'
	//. $letter->stringPresentation() 
	. '</div>';
	echo "<div class='options_container'>";
	foreach ($letter->getFamily() as $fLetter ) {
		echo "<div class='option'>" .
	 		 $fLetter->stringPresentation() 
		. "</div>";
	}
	 
	 echo "</div>";
}


echo '</div>';


														

echo '
<style>
.letter {
	display: inline;
	padding: 0px;
	margin: 0px;
}
.arabic_letter {
	display: inline-block;
	direction: "rtl";
}

div.options_container {
	width:30px;
	height:30px;
	overflow-y: hidden;
	overflow-x: hidden;
	display: inline-block;
}

div.option {
	background-color: red;
	width:30px;
	height:30px;
}

</style>
<script>
$(".letter").click(function() {
	console.log("Handler for .click() called." + $(this).text() );

});

	$(".options_container").scrollTop(0);


$(".options_container").click(function() {
	console.log("Handler for .click() called." + $(this).scrollTop() +  " " + $(this).prop("scrollHeight") );
	if ($(this).scrollTop() + $(this).height() == $(this).prop("scrollHeight")) {
		$(this).scrollTop( 0 );
	} else {
		$(this).scrollTop( $(this).scrollTop() + 30 );
	}
});
	

</script>
';
echo "</body>";
echo "</html>";

// var_dump ( Letter::$families );

?>