<?php

requireLogin();

useScript( "validate-project.php" );

preload( 32, 32, "no.png" );
preload( 32, 32, "yes.png" );
preload( 32, 32, "loading.png" );

$TITLE = "Oh noes!";
$CONTENT .= "
<h1>So. You have a problem. Well whoopdie do. Don't we all</h1>
<br />
<br />
<div id = 'images' ></div>
<form action = '" . $SITE_PREFIX . "submit-bug.php' method = 'post' >
	<table>
<tr>
	<td>What project is giving you crap?</td>
	<td><div id = 'project-ok' ><img src = '" . $SITE_PREFIX . "imgs/no.png' alt = '' /></div></td>
	<td><input type = 'text' id = 'project' name = 'project' size = '20' /></td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td><div id = 'project-descr' >&nbsp;</div></td>
</tr>
<tr>
	<td>So, I need a poetic name for this issue</td>
	<td></td>
	<td><input type = 'text' name = 'title' size = '40' /></td>
</tr>
<tr>
	<td>And a nice description</td>
	<td></td>
	<td><textarea rows = '20' cols = '50' name = 'descr' ></textarea></td>
</tr>
<tr>
	<td></td>
	<td><div id = 'project-ok' ><img src = '" . $SITE_PREFIX . "imgs/32_space.png' alt = '' /></div></td>
	<td><input type = 'submit' value = 'Look, I made this for you!' /></td>
</tr>
	</table>
</form>
";

?>
