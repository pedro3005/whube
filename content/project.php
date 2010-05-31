<?php

// useScript( "jQuery.js" );

include( "model/project.php" );

$p = new project();


$p->getAllByPK( $argv[1] );
$row = $p->getNext();

if ( isset ( $row['pID'] ) ) {
	$TITLE = $row['project_name'] . ", one of the fantastic projects on Whube";
	$CONTENT = "
<h1>" . $row['project_name'] . "</h1>
Badass. 

";
} else {
	$_SESSION['err'] = "Project " . $argv[1] . " does not exist!";
	header( "Location: $SITE_PREFIX" . "t/home" );
	exit(0);
}

?>
