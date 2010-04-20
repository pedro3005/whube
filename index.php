<?php
session_start();
include ( "conf/site.php" );

$TITLE   = "Welcome!";
$CONTENT = "
<h1>Welcome to ToDo</h1>
ToDo is an easy to use and very annoying todo list.
It will bug the ever living christ out of you to get stuff done
but by god, you will get it done. Loads of fun integration,
and nowhere to run.<br />
<br />
<a href = '" . $SITE_PREFIX . "t/login' >Login</a>
";

include( "view/view.php" );

?>
