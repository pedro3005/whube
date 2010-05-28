<?php

$js_root	= dirname(  __FILE__ ) . "/";

include( $js_root . "../../conf/site.php" );
include( $js_root . "../../libs/php/globals.php" );

header( "Content-type: text/javascript" );

?>
window.onload = function() {
	$('#edit-bug').hide();
	$('#edit-button').click(function() {
		$('#edit-bug').show();
	});
}
