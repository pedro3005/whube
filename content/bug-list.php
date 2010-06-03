<?php

$Count = $PAGE_MAX_COUNT;

if ( isset( $argv[2] ) ) {
	$class = htmlentities($argv[1], ENT_QUOTES);
	$id    = htmlentities($argv[2], ENT_QUOTES);
	// echo "Getting $id bugs filtering by $class";
}

include( "model/bug.php" );
$b = new bug();
$b->getAll();

$TITLE = "Latest $Count bugs";

$i = 0;

$CONTENT .= "<h1>Last $Count bugs filed</h1>";

$CONTENT .= "

<div class = 'shade' >
<table class = 'center' >
	<tr>
		<td><a href = '" . $SITE_PREFIX . "t/new-bug' ><img src = '" . $SITE_PREFIX . "imgs/new.png' alt = 'New' /></a></td>
	</tr>

	<tr>
		<td>New Bug</td>
	</tr>
</table>
</div>

<br />
<br />
<br />

<table>
	<tr><th>ID</th><th>Title</th></tr>
";

while ( $row = $b->getNext() ) {
	if ( $i < $Count ) {
		$CONTENT .= "\t<tr>\n<td>" . $row['bID'] . "</td><td><a href = '" . $SITE_PREFIX . "t/bug/" . $row['bID'] . "' >" . $row['title'] . "</a></td>\n\t</tr>\n";
	} else {
		break;
	}
	$i++;
}

$CONTENT .= "
</table><br /><br />
";

?>
