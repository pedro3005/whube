<?php

session_start();
// requireLogin();

include( "conf/site.php" );
include( "libs/php/globals.php" );

$app_root = dirname(  __FILE__ ) . "/";
include( $app_root . "model/user.php" );

$s = new sql();

function clean( $foo ) {
	return htmlentities( mysql_real_escape_string( $foo ) );
}

$d['errors'] = true;
$d['success'] = false;
$d['message'] = "Unknown error";

if ( isset ( $_GET['p'] ) ) {

	$id = clean( $_GET['p'] );

	$p = new user();
	$p->searchByKey( "username", $id );
	$d['message'] = "Query executed with success " . $id . ".";
	$d['numrows'] = $p->numRows();
	if ( $p->numRows() < 1 ) {
		$d['message']   = "No project matches " . $id . ".";
		$d['bestmatch'] = "";
		$d['success'] = false;
	} else {
		$row = $p->getNext();
		$d['message'] = "We have a result for " . $id . ".";
		$d['bestmatch'] = $row['username'];
		if ( $row['username'] == $id ) {
			$d['success'] = true;
			$d['descr'] = $row['real_name'];
		}
	}

} else {
	$d['errors']  = true;
	$d['success'] = false;
	$d['message'] = "I don't know what user to lookup!";
}
echo json_encode( $d );
?>
