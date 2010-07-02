<?php
    /*
     *  License:     GPLv3
     *  Author:      Paul Tagliamonte <paultag@whube.com>
     *  Description:
     *    User rights
     */

if ( ! class_exists ( "rights" ) ) {

if ( ! class_exists( "dbobj" ) ) {
        // last ditch...
        $model_root = dirname(  __FILE__ ) . "/";
        include( $model_root . "dbobj.php" );
}

class rights extends dbobj {
	function rights() {
		dbobj::dbobj("user_rights", "userID");
	}
}
}

$RIGHTS_OBJECT = new rights();

?>
