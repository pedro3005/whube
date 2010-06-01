<?php
include( "model/project.php" );
$p = new project();
$p->getByCol( "project_name", $argv[1] ); // this is goddamn awesome
$row = $p->getNext();

if ( isset ( $row['pID'] ) ) {
	$TITLE = $row['project_name'] . ", one of the fantastic projects on Whube";
	$CONTENT = "
<h1>" . $row['project_name'] . "</h1>
" . $row['descr'] . "<br />
";
} else {
	$_SESSION['err'] = "Project " . $argv[1] . " does not exist!";
	header( "Location: $SITE_PREFIX" . "t/home" );
	exit(0);
}

?>
