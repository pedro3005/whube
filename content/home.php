<?php

include( "model/user.php" );
include( "libs/php/core.php" );

requireLogin();

$TITLE    = "Welcome Home!";

$CONTENT  = "<br /><h1>Heyya, " . $_SESSION['real_name'] . "</h1>Welcome Home.<br /><br /><br />\n";
$CONTENT .= $ABOUT_WHUBE;


?>
