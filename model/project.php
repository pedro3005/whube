<?php
    /*
     *  License:     GPLv3
     *  Author:      Paul Tagliamonte <paultag@ubuntu.com>
     *  Description:
     *    project class
     */
if ( ! class_exists ( "project" ) ) {

if ( ! class_exists( "dbobj" ) ) {
        // last ditch...
        $model_root = dirname(  __FILE__ ) . "/";
        include( $model_root . "dbobj.php" );
}

class project extends dbobj {
	function project() {
    dbobj::dbobj("projects", "pID");
	}
}
}
?>
