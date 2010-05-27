<?php
    /*
     *  License:     GPLv3
     *  Author:      Paul Tagliamonte <paultag@ubuntu.com>
     *  Description:
     *   bug class
     */
if ( ! class_exists ( "bug" ) ) {

if ( ! class_exists( "dbobj" ) ) {
        // last ditch...
        $model_root = dirname(  __FILE__ ) . "/";
        include( $model_root . "dbobj.php" );
}

class bug extends dbobj {
	function bug() {
		dbobj::dbobj("bugs", "bID");
	}
}
}
?>
