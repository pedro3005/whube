<?php
session_start();
include ( "conf/site.php" );

$TITLE   = "Welcome!";
$CONTENT = "
<h1>Welcome to Whube!</h1>
Whube v 3.141
<br />
<a href = '" . $SITE_PREFIX . "t/login' >Go Home!</a>
<br /><br />
<div class = 'center' >
<table>

	<tr>
		<td><img src = '" . $SITE_PREFIX . "imgs/users.png' alt = '' /></td>
		<td><img src = '" . $SITE_PREFIX . "imgs/bugs.png' alt = '' /></td>
		<td><img src = '" . $SITE_PREFIX . "imgs/design.png' alt = '' /></td>
		<td><img src = '" . $SITE_PREFIX . "imgs/new-user.png' alt = '' /></td>
	</tr>
	<tr>
		<td>Login</td>
		<td>Search for some Bugs</td>
		<td>Find a project</td>
		<td>Create an account</td>
	</tr>

</table>
</div>
";

include( "view/view.php" );

?>
