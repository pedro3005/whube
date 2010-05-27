<?php

useScript( "jQuery.js" );
useScript( "file-bug.php" );

$TITLE = "Oh noes!";
$CONTENT .= "
<h1>So. You have a problem. Well whopdie do. Don't we all</h1>
<br />
<br />
<div id = 'images' ></div>
<form action = '" . $SITE_PREFIX . "submit-bug.php' method = 'post' >
	<table>
<tr>
	<td>What project is giving you crap?</td>
	<td><input type = 'text' id = 'project' name = 'project' size = '20' /></td>
	<td><div id = 'project-ok' ><img src = '" . $SITE_PREFIX . "imgs/no.png' alt = '' /></div></td>
</tr>
<tr>
	<td>So, I need a poetic name for this issue</td>
	<td><input type = 'text' name = 'title' size = '40' /></td>
	<td></td>
</tr>
<tr>
	<td>And a nice description</td>
	<td><textarea rows = '20' cols = '50' ></textarea></td>
	<td></td>
</tr>
<tr>
	<td></td>
	<td><input type = 'submit' value = 'Look, I made this for you!' /></td>
	<td></td>
</tr>
	</table>
</form>
";

?>
