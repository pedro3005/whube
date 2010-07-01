<?php

session_start();

if ( ! isset ( $_SESSION['id'] ) ) {
	$_SESSION['id'] = -1;
}

$app_root        = dirname(  __FILE__ ) . "/";
$controller      = basename( __FILE__ );

include( $app_root . "conf/site.php" );
include( $app_root . "libs/php/globals.php" );
include( $app_root . "libs/php/easter.php" );

include( $app_root . "conf/site.php" );
include( $app_root . "libs/php/globals.php" );

include( $app_root . "model/sql.php" );
include( $app_root . "model/bug.php" );
include( $app_root . "model/user.php" );
include( $app_root . "model/project.php" );
include( $app_root . "model/events.php" );

header( "Wisdom-Turd: " . getQuip() );

$p = htmlentities( $_GET['p'], ENT_QUOTES);
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

