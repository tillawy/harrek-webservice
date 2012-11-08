<?php
$xml = new SimpleXMLElement( $str = file_get_contents('letters3.xml' , true) );
foreach ($xml->children() as $s) {
		  print( $s->ContextualForms->Isolated
					 . "\t" .  $s->ContextualForms->Final 
					 . "\t" . $s->ContextualForms->Medial 
					 . "\t" . $s->ContextualForms->Initial
					 . "\n"
		  );
}
?>
