<?php

if ( isset ( $_SESSION['id'] ) ) {
	header( "Location: " . $SITE_PREFIX . "t/home" );
}

$TITLE   = "Login Page";
$CONTENT = "

<form action = '" . $SITE_PREFIX . "gate.php' method = 'post' >
<table>
	<tr>
		<td>Login Name</td>
		<td><input type = 'text' name = 'name' /></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type = 'password' name = 'pass' /></td>
	</tr>
	<tr>
		<td></td>
		<td><input name = 'login' type = 'submit' value = 'Let me in!' /></td>
	</tr>
</table>
</form>

";


?>

