<?php

// Read all upper-case comments in a thick
// Germish accent

include ( "corelib.php" ); // ZIE FUNCTIONZ
include ( "coreid.php" );  // ZIE IDENTIFICATION FUR THE API

$d = array();

$d['error'] = "false";	// default mode is failure.
			// when in doubt, treat it as
			// a big failure.

$p = htmlentities( $_GET['p'] );
$ps = explode( "/", $p );

if ( sizeof( $ps ) == 2 ) { // VIE VILL HAVE ONLY TWO ARGUMENTS!
	$class   = $ps[0];  // KLASS
	$request = $ps[1];

	note( "class",   $class   ); // PUT ZEZE THINGS INS HEADER
	note( "request", $request ); // BEKAUZ ZIS IS EASY ZU PARSE

	$d['metadata'] = array();    // INFOMRATION ABOUT THE GODDAMN
	$d['metadata']['class']   = $class;   // INFORMATION THAT
	$d['metadata']['request'] = $request; // THEY WANT TO BE INFORMED ABOUT

	// VIE MUST QUERY FUR DIE DATA


	// AUSGESEICHNET

} else { // too few or too many. 
	note( "error", "argument-mismatch" );
	$d['error'] = "true";
}

echo json_encode( $d ) . "\n";

?>
