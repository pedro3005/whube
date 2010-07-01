<?php

useScript( "validate-user.php" );
useScript( "validate-project.php" );
useScript( "edit-menu.js" );

$b = new bug();
$u = new user();
$p = new project();


$b->getAllByPK( $argv[1] );
$row = $b->getNext();

if ( $row['private'] && isset ( $row['bID'] ) ) {
	// uh oh. let's make sure they are not punkassbitches

	$reporter = $b->getReporter( $row['bID'] );
	$owner    = $b->getOwner(    $row['bID'] );
	$project  = $b->getProject(  $row['bID'] );

	if (
		( $reporter['uID'] != $_SESSION['id'] ) &&
		(    $owner['uID'] != $_SESSION['id'] ) &&
		(  $project['oID'] != $_SESSION['id'] )
	) {
		$_SESSION['err'] = "This is a private bug. You are not the owner, reporter or project leader.";
		header("Location: " . $SITE_PREFIX . "t/home" );
		exit(0);
	} else {
		$_SESSION['msg'] = "This is a private bug. Please keep this quiet.";
	}
}

if ( isset ( $row['bID'] ) ) {

	$p->getAllByPK( $row['package'] );
	$project = $p->getNext();

	$reporter = $b->getReporter( $row['bID'] );
	$owner    = $b->getOwner(    $row['bID'] );
	$project  = $b->getProject(  $row['bID'] );

	if ( ! isset ( $owner['uID'] ) ) {
		$owner_info = "No owner!";
	}

	$TITLE = "Bug #" . $row['bID'] . " | " . $row['title'];

if ( loggedIn() ) {

	$CONTENT .= "
<h1>" . $row['title'] . "</h1>
<div class = 'shade' >
<table class = 'center' >
	<tr><td><img id = 'edit-bug-control' src = '" . $SITE_PREFIX . "imgs/edit.png' alt = 'edit' /></td></tr>
	<tr><td>Edit this bug</td></tr>
</table>
</div>

<div id = 'edit-bug' >
<div class = 'lookatme' >
	<div id = 'edit-interface' class = 'container' >
		<div class = 'prompt' >
			<div class = 'content' >
<img id = 'edit-close' src = '" . $SITE_PREFIX . "imgs/close.png' alt = 'Close' />
<h1>Edit this bug: </h1>
	<form action = '" . $SITE_PREFIX . "bug-callback.php' method = 'post' >
		<p><input type = 'hidden' value = '" . $row['bID'] . "' name = 'bID' /></p>

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
		<td>Private</td>
		<td></td>
		<td><input type = 'checkbox' value = 'true' name = 'private' ";


	if ( $row['private'] ) {
		$CONTENT .= " checked='true' ";
	}

$CONTENT .= "/></textarea></td>
	</tr>

	<tr>
		<td>Title</td>
		<td></td>
		<td><input value = \"" . $row['title'] . "\" type = 'text' name = 'title' /></td>
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
</select></td>
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

$CONTENT .= "</select></td>
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
		<td>Description</td>
		<td></td>
		<td><textarea name = 'descr' rows = '10' cols = '50' >" . $row['descr'] . "</textarea></td>
	</tr>
	<tr>
		<td></td>
		<td><img src = '" . $SITE_PREFIX . "imgs/32_space.png' alt = '' /></td>
		<td><input type = 'submit' value = 'Make it so' /></td>
	</tr>
</table>
	</form>
			</div>
		</div>
	</div>
</div>
</div><br />
<br />
<br />
";

}


$CONTENT .= "
<table>

	<tr>
		<td>Project</td>
		<td></td>
		<td>" . $project['project_name'] . " ( <a href = '" . $SITE_PREFIX . "t/project/" . $project['project_name'] . "' >" . $project['project_name'] . "</a> )</td>
	</tr>

	<tr>
		<td>Reporter</td>
		<td></td>
		<td>" . $reporter['real_name'] . " ( <a href = '" . $SITE_PREFIX . "t/user/" . $reporter['username'] . "' >" . $reporter['username'] . "</a> )</td>
	</tr>
	<tr>
		<td>Created</td>
		<td></td>
		<td>" . date( "F j, o", $row['startstamp'] ) . "</td>
	</tr>
	<tr>
		<td>Last Modified</td>
		<td></td>
		<td>" . date( "F j, o", $row['trampstamp'] ) . "</td>
	</tr>

	<tr>
		<td>Owner</td>
		<td></td>
";

	if ( isset ( $owner['uID'] ) ) {
		$CONTENT .= "
		<td>" . $owner['real_name'] . " ( <a href = '" . $SITE_PREFIX . "t/user/" . $owner['username'] . "' >" . $owner['username'] . "</a> )</td>";
	} else {
		$CONTENT .= "
		<td>No Owner</td>";
	}



$CONTENT .= "

	</tr>
";

$status   = getStatus(   $row['bug_status'] );
$severity = getSeverity( $row['bug_severity'] );

$statusIcon   = "";
$severityIcon = "";

if ( $status['critical'] ) {
$statusIcon   = "<img src = '" . $SITE_PREFIX . "imgs/warning.png' alt = 'Critical' />";
} else {
$statusIcon   = "<img src = '" . $SITE_PREFIX . "imgs/happy.png' alt = 'Non-Critical' />";
}

if ( $severity['critical'] ) {
$severityIcon   = "<img src = '" . $SITE_PREFIX . "imgs/warning.png' alt = 'Critical' />";
} else {
$severityIcon   = "<img src = '" . $SITE_PREFIX . "imgs/happy.png' alt = 'Non-Critical' />";
}


$CONTENT .= "

	<tr>
		<td>Status</td>
		<td>" . $statusIcon . "</td>
		<td>" . $status['status_name'] . "</td>
	</tr>
	<tr>
		<td>Severity</td>
		<td>" . $severityIcon . "</td>
		<td>" . $severity['severity_name'] . "</td>
	</tr>


</table>
<br />
<h1>Bug Description</h1>
<pre>" . $row['descr'] . "</pre>
";

} else {
	$_SESSION['err'] = "Bug #" . $argv[1] . " does not exist!";
	header( "Location: $SITE_PREFIX" . "t/home" );
	exit(0);
}

?>
