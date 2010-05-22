<?php

function debug( $id ) {
	echo $id . "<br />\n";
}

function note( $id, $key ) {
	header( "$id: $key" );
}

?>
