<?php

$app_root = dirname(  __FILE__ ) . "/";
include( $app_root . "model/project.php" );

$s = new sql();

function clean( $foo ) {
	return htmlentities( mysql_real_escape_string( $foo ) );
}

$d['errors'] = true;
$d['success'] = false;
$d['message'] = "Unknown error";

if ( isset ( $_GET['p'] ) ) {

	$id = clean( $_GET['p'] );

	$p = new project();
	$p->searchByKey( "project_name", $id );
	$d['message'] = "Query executed with success " . $id . ".";
	$d['numrows'] = $p->numRows();
	if ( $p->numRows() < 1 ) {
		$d['message']   = "No project matches " . $id . ".";
		$d['bestmatch'] = "";
		$d['success'] = false;
	} else {
		$row = $p->getNext();
		$d['message'] = "We have a result for " . $id . ".";
		$d['bestmatch'] = $row['project_name'];
		if ( $row['project_name'] == $id ) {
			$d['success'] = true;
			$d['descr'] = $row['descr'];
		}
	}

} else {
	$d['errors']  = true;
	$d['success'] = false;
	$d['message'] = "I don't know what project to lookup!";
}
echo json_encode( $d );
?>
