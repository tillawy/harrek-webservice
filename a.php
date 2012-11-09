

<html>
 	<head>
 	<script src="http://127.0.0.1/~mohammed/letters/jquery-1.8.2.min.js"></script>
 	</head>
 	<body>

<?
require_once('./Classes/Vocabulary.php'); 
require_once('./Classes/Letter.php'); 
require_once('./Classes/Puzzle.php');
header('Content-Type: text/html; charset=utf-8');

?>
 
<?
$puzzle = Puzzle::PuzzleWithFile('./b.txt');
$puzzle->difficulty = PuzzleDifficulty::ADVANCED;
?>

<div classs="arabic_letter" direction="rtl" dir="rtl" align="right">
<?/*
foreach ($puzzle->sentence as $letter) {
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
*/
?>
</div>



<div classs="arabic_letter" direction="rtl" dir="rtl" align="right">
<?

for ($i=0; $i < count($puzzle->sentence) ; $i++){ 
	$letter = $puzzle->getLetterAtIndex($i);
	echo "<div class='options_container' correctIndex='" . $letter->positionInFamily() . "'>";
	if ($letter->randomize){
		foreach ($letter->getFamily() as $fLetter ) {
			$correct = $fLetter->matchesLetter($letter) ? 1 : 0;
			echo "\t<div class='option' isCorrect='" . $correct . "'>" .
			$fLetter->stringPresentation() 
			. "</div>\n";
		}
		//echo "\t<div class='option empty'>XX</div>\n";
	} else {
		echo "\t<div class='nooption'>" . $letter->stringPresentation() . "</div>\n";
	}
	 echo "</div>\n";	
}

?>
</div>


														


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

div.correctOption {
	color: white;
}

</style>
<script>
$(".letter").click(function() {
	console.log("Handler for .click() called." + $(this).text() );

});

$(".options_container").scrollTop(0);


$(".option").click(function() {
	//console.log("option" +$(this).attr("isCorrect") );
	//$(this).addClass("answered");
});


$(".options_container").click(function() {
	
	if ($(this).scrollTop() + $(this).height() == $(this).prop("scrollHeight")) {
		$(this).scrollTop( 0 );
	} else {
		$(this).scrollTop( $(this).scrollTop() + 30 );
	}

	var singleItemHeight = $(this).prop("scrollHeight") / $(this).children().length ;
	var scrollBottom = $(this).prop("scrollHeight") - $(this).scrollTop();
	var currentIndex = $(this).scrollTop() / $(this).prop("scrollHeight") * $(this).children().length;

	if ( $(this).attr("correctIndex") == currentIndex ) {
		$(this).children().addClass("correctOption");
	} else {
		$(this).children().removeClass("correctOption");
	}

});
	

</script>

</body>
</html>