<?php
session_start();
include ( "conf/site.php" );

$TITLE   = "Welcome!";
$CONTENT = "
<h1>Welcome to Whube!</h1>
Whube v 3.141
<br />
<a href = '" . $SITE_PREFIX . "t/login' >Go Home!</a>
";

include( "view/view.php" );

?>
