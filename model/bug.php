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

include ( $model_root . "user.php" );
include ( $model_root . "project.php" );

class bug extends dbobj {
	function bug() {
		dbobj::dbobj("bugs", "bID");
	}
	// Let's add in some functionallity for user stuff.
	function getOwner( $bID ) {
		$this->getAllByPK( $bID );
		$row = $this->getNext();
		$u = new user();
		$u->getAllByPK( $row['owner'] );
		return $u->getNext();
	}
	function getReporter( $bID ) {
		$this->getAllByPK( $bID );
		$row = $this->getNext();
		$u = new user();
		$u->getAllByPK( $row['reporter'] );
		return $u->getNext();
	}
	function getProject( $pID ) {
		$this->getAllByPK( $pID );
		$row = $this->getNext();
		$p = new project();
		$p->getAllByPK( $row['package'] );
		return $p->getNext();
	}
}
}


$BUG_OBJECT = new bug();

?>
