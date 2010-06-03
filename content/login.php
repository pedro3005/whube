<?php

if ( isset ( $_SESSION['id'] ) ) {
	header( "Location: " . $SITE_PREFIX . "t/home" );
}

useScript( "md5.js" );
useScript( "login.js" );

$_SESSION['token'] = md5( time() );
$TOKEN = $_SESSION['token'];

$TITLE   = "Login Page";
$CONTENT = "

<form action = '" . $SITE_PREFIX . "gate.php' method = 'post' >
<p>
	<input type = 'hidden' name = 'token' value = '" . $TOKEN . "' />
</p>
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
		<td><input name = 'login' type = 'submit' value = 'Let me in!' onclick = 'preSubmit(this.form)' /></td>
	</tr>
</table>
</form>

";


?>

