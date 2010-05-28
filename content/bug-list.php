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

$CONTENT .= "<h1>Last $Count bugs filed</h1>";

while ( $row = $b->getNext() ) {
	if ( $i < $Count ) {
		$CONTENT .= "Bug ID #" . $row['bID'] . ", \"<a href = '" . $SITE_PREFIX . "t/bug/" . $row['bID'] . "' >" . $row['title'] . "</a>\"<br />\n";
	} else {
		break;
	}
	$i++;
}

?>
