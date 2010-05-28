<?php

session_start();

$app_root        = dirname(  __FILE__ ) . "/";
$controller      = basename( __FILE__ );

include( $app_root . "conf/site.php" );
include( $app_root . "libs/php/globals.php" );

$p = htmlentities( $_GET['p'] );
$toks = explode( "/", $p );

$argv = $toks;
$argc = sizeof( $toks );

if (
	isset ( $toks[0] ) &&
	$toks[0] != ""
) {
	$idz = $app_root . "content/" . basename( $toks[0] ) . ".php";
	if ( file_exists( $idz ) ) {
		include( $idz );
	} else {
		include( $app_root . "content/default.php" );
	}
} else {
	header("Location: $SITE_PREFIX");
}

include( $app_root . "view/view.php" );

?>

