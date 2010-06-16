<?php

$Count = $PAGE_MAX_COUNT;

if ( isset( $argv[2] ) ) {
	$class = htmlentities($argv[1], ENT_QUOTES);
	$id    = htmlentities($argv[2], ENT_QUOTES);
	// echo "Getting $id bugs filtering by $class";
}

include( "model/bug.php" );
include( "model/user.php" );
include( "model/project.php" );

$b = new bug();
$b->getAll();

$u = new user();
$p = new project();

$TITLE = "Latest $Count bugs";

$i = 0;

$CONTENT .= "<h1>Last $Count bugs filed</h1>";

$CONTENT .= "
<table>
	<tr>
		<th>ID</th> <th>Owner</th> <th>Project</th> <th>Title</th>
	</tr>
";

while ( $row = $b->getNext() ) {

	$u->getAllByPK( $row['owner'] );
	$owner = $u->getNext();

	$p->getAllByPK( $row['package'] );
	$package = $p->getNext();

	if ( $row['private'] || $package['private'] ) {
		if ( $i < $Count ) {
			$CONTENT .= "\t<tr>\n<td>" . $row['bID'] . "</td><td>Unknown</td><td>Private</td><td>Private</td>\n\t</tr>\n";
		} else {
			break;
		}
	} else {
		if ( $i < $Count ) {
			$CONTENT .= "\t<tr>\n<td>" . $row['bID'] . "</td><td>" . $owner['real_name'] . "</td><td>" . $package['project_name'] . "</td><td><a href = '" . $SITE_PREFIX . "t/bug/" . $row['bID'] . "' >" . $row['title'] . "</a></td>\n\t</tr>\n";
		} else {
			break;
		}
	}
	$i++;
}

$CONTENT .= "
</table><br /><br />
";

?>
