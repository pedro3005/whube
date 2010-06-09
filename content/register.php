<?php
useScript('timezone.js');
$TITLE    = "Register for Whube!";
$CONTENT  = "
<h1>So, you want an account, eh?</h1>
<form action = '" . $SITE_PREFIX . "submit-register.php' method = 'post' >
<table>
	<tr>
		<td>Desired Username</td>
		<td></td>
		<td><input type = 'text' name = 'username' id = 'username' /></td>
	</tr>
	<tr>
		<td>Your Real Name ( First and Last, please )</td>
		<td></td>
		<td><input type = 'text' name = 'realname' id = 'realname' /></td>
	</tr>
	<tr>
		<td>Password ( take one )</td>
		<td></td>
		<td><input type = 'password' name = 'pass0' id = 'pass0' /></td>
	</tr>
	<tr>
		<td>Email addy</td>
		<td></td>
		<td><input type = 'text' name = 'email' id = 'email' /></td>
	</tr>
	<tr>
		<td>Password ( take two )</td>
		<td></td>
		<td><input type = 'password' name = 'pass1' id = 'pass1' /></td>
	</tr>
	<tr>
		<td><input type = 'hidden' name = 'tz' id = 'tz' /></td>
		<td></td>
		<td><input type = 'submit' name = 'new-user' id = 'submit' value = 'will you remember me?' /></td>
	</tr>
</table>
</form>
";

?>
