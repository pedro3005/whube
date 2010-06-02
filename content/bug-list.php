<?php

$Count = 200;

if ( isset( $argv[1] ) ) {
	$Count = $argv[1];
}

include( "model/bug.php" );
$b = new bug();
$b->getAll();

$TITLE = "Latest $Count bugs";

$i = 0;

$CONTENT .= "<h1>Last $Count bugs filed</h1>";

$CONTENT .= "

<table>
";

while ( $row = $b->getNext() ) {
	if ( $i < $Count ) {
		$CONTENT .= "\t<tr>\n<td>Bug ID #" . $row['bID'] . "</td><td>\"<a href = '" . $SITE_PREFIX . "t/bug/" . $row['bID'] . "' >" . $row['title'] . "</a>\"</td>\n\t</tr>\n";
	} else {
		break;
	}
	$i++;
}

$CONTENT .= "
</table><br /><br />
<a href = '" . $SITE_PREFIX . "t/new-bug' >New Bug</a>
";

?>
