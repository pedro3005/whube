<?php

useScript( "jQuery.js" );            // dep   #1
useScript( "validate-user.php" );    // needs #1
useScript( "validate-project.php" ); // needs #1

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

	$reporter = $b->getReporter( $row['bID'] );
	$owner    = $b->getOwner(    $row['bID'] );
	$project  = $b->getProject(  $row['bID'] );

	if ( ! isset ( $owner['uID'] ) ) {
		$owner_info = "No owner!";
	}

	$TITLE = "Bug #" . $row['bID'];

	$CONTENT .= "
<h1>" . $row['title'] . "</h1>
<div id = 'edit-bug' >
	<form action = '" . $SITE_PREFIX . "bug-callback.php' method = 'post' >
		<input type = 'hidden' value = '" . $row['bID'] . "' name = 'bID' />

<table>
	<tr>
		<td>Project</td>
		<td><div id = 'project-ok' ><img src = '" . $SITE_PREFIX . "imgs/no.png' alt = '' /></div></td>
		<td><input type = 'text' value = '" . $project['project_name'] . "' id = 'project' name = 'project' size = '20' /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><div id = 'project-descr' >&nbsp;</div></td>
	</tr>
	<tr>
		<td>Title</td>
		<td></td>
		<td><input value = '" . $row['title'] . "' type = 'text' name = 'title' /></td>
	</tr>
	<tr>
		<td>Status</td>
		<td></td>
		<td><select name = 'status' >
";

$status   = getAllStatus();
foreach ( $status as $key ) {
	$hook = "";
	if ( $key['statusID'] == $row['bug_status'] ) {
		$hook = ' selected = "selected" ';
	}
	$CONTENT .= "<option value = '" . $key['statusID'] . "' $hook >" . $key['status_name'] . "</option>\n";
}

$CONTENT .= "
</td>
	</tr>
	<tr>
		<td>Severity</td>
		<td></td>
		<td><select name = 'severity' >";

$severity = getAllSeverity();
foreach ( $severity as $key ) {
	$hook = "";
	if ( $key['severityID'] == $row['bug_severity'] ) {
		$hook = ' selected = "selected" ';
	}
	$CONTENT .= "<option value = '" . $key['severityID'] . "' $hook >" . $key['severity_name'] . "</option>\n";
}

$CONTENT .= "</severity></td>
	</tr>
	<tr>
		<td>Owner</td>
		<td><div id = 'user-ok' ><img src = '" . $SITE_PREFIX . "imgs/no.png' alt = '' /></div></td>
		<td><input type = 'text' value = '" . $owner['username'] . "' id = 'user' name = 'owner' size = '20' /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><div id = 'user-descr' >&nbsp;</div></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><input type = 'submit' value = 'Make it so' /></td>
	</tr>
</table>
	</form>
</div>
This bug is against <b>" . $project['project_name'] . "</b><br />
<b>" . $reporter['real_name'] . " ( " . $reporter['username'] . " )</b>, that troublemaker, reported this bug.<br />
";

	if ( isset ( $owner['uID'] ) ) {
		$CONTENT .= "This bug is being hacked on by <b>" . $owner['real_name'] . "</b><br />";
	} else {
		$CONTENT .= "Sadly, this bug has no owner. Adopt me!</b><br />";
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
