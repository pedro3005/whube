<?php

class user extends dbobj {
	function user() {
		dbobj::dbobj("users", "uid");
	}
}

?>
