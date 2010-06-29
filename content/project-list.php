<?php

$Count = $PAGE_MAX_COUNT;

if ( isset( $argv[2] ) ) {
	$class = htmlentities($argv[1], ENT_QUOTES);
	$id    = htmlentities($argv[2], ENT_QUOTES);
}

include( "model/bug.php" );
include( "model/user.php" );
include( "model/project.php" );

$TITLE = "Latest $Count projects";

$i = 0;

$CONTENT .= "<h1>Last $Count projects created</h1>";

$CONTENT .= "
<table>
	<tr>
		<th>Name</th> <th>Owner</th> <th>Bugs</th> <th>Private</th>
	</tr>
";

$p = new project();
$p->getAll();

while ( $row = $p->getNext() ) {


	$i++;
}

$CONTENT .= "
</table><br /><br />
";

?>
