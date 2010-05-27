<?php

include( "model/user.php" );

$TITLE    = "Welcome Home!";

$realname = $_SESSION['real_name'];

$CONTENT .= <<<EOF
<h1>Welcome Home!</h1>
So, welcome back, $realname. Looks like you are
logged in and everything. Boohyeah. Well this, as
you know, is Whube.<br />
<br />
EOF;

$CONTENT .= "<a href = '" . $SITE_PREFIX . "t/logout' >Logout</a><br />";




?>
