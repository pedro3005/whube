<?php

$Count = $PAGE_MAX_COUNT;

if ( isset( $argv[2] ) ) {
	$class = htmlentities($argv[1], ENT_QUOTES);
	$id    = htmlentities($argv[2], ENT_QUOTES);
}

include( "model/bug.php" );
include( "model/user.php" );
include( "model/project.php" );

?>
