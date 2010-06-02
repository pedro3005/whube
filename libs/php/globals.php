<?php

$php_root = dirname(  __FILE__ ) . "/";

include( $php_root . "../../model/sql.php" );

$JS_ROOT = $php_root . "../js/";

function useScript( $id ) {
	global $SCRIPT, $JS_ROOT;
	if ( file_exists( $JS_ROOT . $id ) ) {
		array_push( $SCRIPT, $id );
	}
}

function preload( $l, $w, $src ) {
	global $PRELOAD;
	$payload = array();
	$payload['w']   = $w;
	$payload['h']   = $l;
	$payload['src'] = $src;

	array_push( $PRELOAD, $payload );
}

function breakUpLine( $line ) {
	$pos = strrpos($line, "/");
	if ($pos === false) {
		return array($line);
	} else {
		$prefix  = trim(substr( $line, 0, $pos ) );
		$postfix = trim(substr( $line, $pos + 1, strlen( $line )) );
		$prefix  = htmlentities( $prefix,  ENT_QUOTES);
		$postfix = htmlentities( $postfix, ENT_QUOTES);

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

function loggedIn() {
	if ( isset ( $_SESSION['id'] ) ) {
		return true;
	} else {
		return false;
	}
}

function getStatus( $status ) {
	if ( isset ( $status ) ) {
		$sql = new sql();
		$sql->query("SELECT * FROM status WHERE statusID = " . $status );
		$ret = $sql->getNextRow();
		return $ret;
	}
}

function getAllStatus() {
	$sql = new sql();
	$sql->query("SELECT * FROM status;" );
	$ret = array();
	while ( $row = $sql->getNextRow() ) {
		array_push( $ret, $row );
	}
	return $ret;
}

function getSeverity( $status ) {
	if ( isset ( $status ) ) {
		$sql = new sql();
		$sql->query("SELECT * FROM severity WHERE severityID = " . $status );
		$ret = $sql->getNextRow();
		return $ret;
	}
}

function getAllSeverity() {
	$sql = new sql();
	$sql->query("SELECT * FROM severity;" );
	$ret = array();
	while ( $row = $sql->getNextRow() ) {
		array_push( $ret, $row );
	}
	return $ret;
}

?>
