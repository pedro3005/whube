<?php

include( "model/bug.php" );
$b = new bug();
$b->getAllByPK( $_GET['args'][1] );

$row = $b->getNext();

$TITLE = "Bug #" . $row['bID'];
$CONTENT = "
<h1>" . $row['title'] . "</h1>
";

?>
