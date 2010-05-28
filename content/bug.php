<?php

include( "model/bug.php" );
include( "model/user.php" );
include( "model/project.php" );

$b = new bug();
$u = new user();
$p = new project();


$b->getAllByPK( $argv[1] );
$row = $b->getNext();

$p->getAllByPK( $row['package'] );
$project = $p->getNext();

$u->getAllByPK( $row['reporter'] );
$reporter = $u->getNext();

$u->getAllByPK( $row['owner'] );
$owner = $u->getNext();


$TITLE = "Bug #" . $row['bID'];
$CONTENT = "
<h1>" . $row['title'] . "</h1>
This bug is against <b>" . $project['project_name'] . "</b><br />
<b>" . $reporter['real_name'] . "</b>, that troublemaker, reported this bug.<br />
";

if ( isset ( $owner['uID'] ) ) {
	$CONTENT .= "This bug is being hacked on by <b>" . $owner['real_name'] . "</b><br />";
}

$status   = getStatus(   $row['bug_status'] );
$severity = getSeverity( $row['bug_severity'] );

$CONTENT .= "It's classified as a " . $status['status_name'] . " bug with a severity level of ";
$CONTENT .= $severity['severity_name'] . ". Is that wrong? Too <br />";

?>
