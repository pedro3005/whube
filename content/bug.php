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

$TITLE = "Bug #" . $row['bID'];
$CONTENT = "
<h1>" . $row['title'] . "</h1>
This bug is against <b>" . $project['project_name'] . "</b><br />
<b>" . $reporter['real_name'] . "</b>, that troublemaker, reported this bug.<br />
";

?>
