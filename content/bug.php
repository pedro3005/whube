<?php

useScript( "jQuery.js" );
useScript( "edit-bug.php" );

include( "model/bug.php" );
include( "model/user.php" );
include( "model/project.php" );

$b = new bug();
$u = new user();
$p = new project();


$b->getAllByPK( $argv[1] );
$row = $b->getNext();

if ( isset ( $row['bID'] ) ) {

	$p->getAllByPK( $row['package'] );
	$project = $p->getNext();

	$u->getAllByPK( $row['reporter'] );
	$reporter = $u->getNext();

	$u->getAllByPK( $row['owner'] );
	$owner = $u->getNext();

	$TITLE = "Bug #" . $row['bID'];

	$CONTENT = "
<h1>" . $row['title'] . "</h1>
<div id = 'edit-bug' >
	<form action = '<?php echo $SITE_PREFIX; ?>bug-callback.php' method = 'post' >
<table>
	<tr>
		<td>Project</td>
		<td><input type = 'text' name = 'project' /></td>
	</tr>
	<tr>
		<td>Title</td>
		<td><input type = 'text' name = 'title' /></td>
	</tr>
	<tr>
		<td>Status</td>
		<td></td>
	</tr>
	<tr>
		<td>Severity</td>
		<td></td>
	</tr>
	<tr>
		<td>Owner</td>
		<td><input type = 'text' name = 'owner' /></td>
	</tr>
</table>
	</form>
</div>
This bug is against <b>" . $project['project_name'] . "</b><br />
<b>" . $reporter['real_name'] . "</b>, that troublemaker, reported this bug.<br />
";

	if ( isset ( $owner['uID'] ) ) {
		$CONTENT .= "This bug is being hacked on by <b>" . $owner['real_name'] . "</b><br />";
	}

	$status   = getStatus(   $row['bug_status'] );
	$severity = getSeverity( $row['bug_severity'] );

	$CONTENT .= "It's classified as a <b>" . $status['status_name'] . "</b> bug with a severity level of ";
	$CONTENT .= "<b>" . $severity['severity_name'] . ".</b><br /><button id = 'edit-button' type = 'Button'>Edit</button>";

} else {
	$_SESSION['err'] = "Bug #" . $argv[1] . " does not exist!";
	header( "Location: $SITE_PREFIX" . "t/home" );
	exit(0);
}

?>
