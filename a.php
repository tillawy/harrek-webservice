<html>
 	<head>
 	<script src="http://127.0.0.1/~mohammed/letters/jquery-1.8.2.min.js"></script>
 	</head>
 	<body>

<?
require_once('./require.php'); 
header('Content-Type: text/html; charset=utf-8');

?>
 
<?
$puzzle = Puzzle::PuzzleWithFile('./c.txt');
$puzzle->difficulty = PuzzleDifficulty::ADVANCED;
//$puzzle->difficulty = PuzzleDifficulty::FLASH;
//$puzzle->difficulty = PuzzleDifficulty::EASY;
?>


<div classs="arabic_letter" direction="rtl" dir="rtl" align="right">
<?

foreach ( $puzzle->words as $_wi => $_word ){
		  echo "<div class='word' order='" . $_wi . "' >\n";
        foreach ( $_word->letters as $_li => $_let){
                $letter = $_word->getLetterAtIndex($_li);
                if ( $puzzle->isLetterRandomizeable( $letter ) ){
                        echo "<div class='container options_container not_correct' correctIndex='" . $letter->positionInFamily() . "'>\n";
                        foreach ($letter->getFamily() as $_fLetter ) {
                                $correct = $_fLetter->matchesLetter($letter) ? 1 : 0;
                                echo "<div class='option' p='$letter->position' isCorrect='" . $correct . "'>" .
                                        $_fLetter->stringPresentation()
                                        . "</div>";
                        }
                        echo "</div>\n";
                } else {
                        echo "<div class='container'>\n";
                        echo "\t<div class='nooption' p='$letter->position'>" . $letter->stringPresentation() . "</div>\n";
                        echo "</div>\n";
                }
        }
		  echo '</div>'; //word;
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

div.word {
	display: inline-block;
	border:1px solid black;
margin-left: 2px;
}
div.container {
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

div.correct {
	background-color: green;
	color: white;
}

div.finished {
	background-color: blue;
	border-color: black;
	border-width: 4px;
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

	var singleItemHeight = $(this).prop("scrollHeight") / $(this).children().length;
	var scrollBottom = $(this).prop("scrollHeight") - $(this).scrollTop();
	var currentIndex = $(this).scrollTop() / $(this).prop("scrollHeight") * $(this).children().length;

	if ( $(this).attr("correctIndex") == currentIndex ) {
		$(this).children().addClass("correct");
		$(this).removeClass("not_correct");
	} else {
		$(this).children().removeClass("correct");
		$(this).addClass("not_correct");
	}


	if ($(".not_correct").length  == 0) {
		console.log("not_correct: " + $(".not_correct").length  == 0);
		console.log("FINISHED");
		$(".option").addClass("finished");
	} else {
		$(".option").removeClass("finished");
	}


});


	

</script>

</body>
</html>
