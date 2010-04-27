<?php

class user extends dbobj {
	function user() {
		dbobj::dbobj("users", "uID");
	}
	function getAllReportedBugs( $id ){
		$d = new defect();
		$d->pk_field = "reporter";
		$d->getByID( $id );
		return $d;
	}
}

?>
