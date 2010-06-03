<?php
session_start();
include ( "conf/site.php" );
include ( "libs/php/core.php" );

$TITLE   = "Welcome!";
$CONTENT = $ABOUT_WHUBE;

include( "view/view.php" );

?>
