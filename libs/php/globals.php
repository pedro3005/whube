<?php

$php_root = dirname(  __FILE__ ) . "/";

$JS_ROOT = $php_root . "../js/";

function useScript( $id ) {
	global $SCRIPT, $JS_ROOT;
	if ( file_exists( $JS_ROOT . $id ) ) {
		array_push( $SCRIPT, $id );
	}
}

function breakUpLine( $line ) {
	$pos = strrpos($line, "/");
	if ($pos === false) {
		return array($line);
	} else {
		$prefix  = trim(substr( $line, 0, $pos ) );
		$postfix = trim(substr( $line, $pos + 1, strlen( $line )) );
		$prefix  = htmlentities( $prefix );
		$postfix = htmlentities( $postfix );

		$ret = array( $prefix, $postfix );
	}
	return $ret;
}

function requireLogin() {
	global $SITE_PREFIX;
	if ( ! isset ( $_SESSION['id'] ) ) {
		$_SESSION['err'] = "Login before you can hit that page!";
		header("Location: " . $SITE_PREFIX . "t/login" );
		exit(0);
	}
}

?>
