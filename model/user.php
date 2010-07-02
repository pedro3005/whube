<?php
    /*
     *  License:     GPLv3
     *  Author:      Paul Tagliamonte <paultag@ubuntu.com>
     *  Description:
     *    uzer class
     */

if ( ! class_exists ( "user" ) ) {

if ( ! class_exists( "dbobj" ) ) {
        // last ditch...
        $model_root = dirname(  __FILE__ ) . "/";
        include( $model_root . "dbobj.php" );
}

class user extends dbobj {
	function user() {
		dbobj::dbobj("users", "uID");
	}
}
}
?>
