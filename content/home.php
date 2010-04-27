<?php

include( "model/sql.php" );   // move this to dbobj
include( "model/dbobj.php" ); // move this to user
include( "model/user.php" );
include( "model/defect.php" );

$TITLE   = "Welcome Home!";
$CONTENT = "

<h1>Welcome Home, " . $_SESSION['real_name'] . " :)</h1>

<form action = '" . $SITE_PREFIX . "gate.php' method = 'POST' >
	<table>
		<tr>
			<td><input type = 'submit' value = 'Logout' name = 'logout' /></td>
			<td>Leaving Us?</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
	</table>
</form>

<h1>Tasks</h1>

	<table>
";


$u = new user();
$d  = $u->getAllReportedBugs( $_SESSION['id'] );

$CONTENT .= "<tr><th>Owner</th><th>Title</th></tr>";

while ( $f = $d->getNext() ) {
	$CONTENT .= "<tr><td>" . $f['owner'] . "</td><td>" . $f['title'] . "</td></tr>";
}

$CONTENT .= "
	</table>

";


?>
