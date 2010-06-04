<?php
	$QUIP_LIST = array();
	function addQuip( $qu ) {
		global $QUIP_LIST;
		array_push( $QUIP_LIST, $qu );
	}

	include( dirname( __FILE__ ) . "/cookies.php" );

	function getQuip() {
		global $QUIP_LIST;
		$id = rand(0,sizeof($QUIP_LIST));
		return $QUIP_LIST[$id];
	}
?>
