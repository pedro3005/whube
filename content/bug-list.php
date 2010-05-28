<?php

$Count = 2;

if ( isset( $argv[1] ) ) {
	$Count = $argv[1];
}

include( "model/bug.php" );
$b = new bug();
$b->getAll();

$TITLE = "Latest $Count bugs";

$i = 0;

while ( $row = $b->getNext() ) {
	if ( $i < $Count ) {
		$CONTENT .= "Bug ID #" . $row['bID'] . ", \"" . $row['title'] . "\"<br />\n";
	} else {
		break;
	}
	$i++;
}

?>
