<?php

	// OVERRIDE THE FOLLOWING IN CODE!

	$CONTENT  = "";
	$TITLE    = "Whube!";
	$SCRIPT   = array();
	$PRELOAD  = array();

	$PAGE_MAX_COUNT = 200;

	$GUILT_ME = true; // The donate banner.
	$TWEETER  = true; // Twitter stuff. check conf/twitter.php

	// CONF THE FOLLOWING

	$SITE_PREFIX   =   "http://localhost/whube/";
  $CREATE_DB     =   1; // If database exists, change to 0.
  $TABLE_PREFIX  =   "whube_"; // So that those on shared hosts with one db can still use it

	array_push( $SCRIPT, "jQuery.js");  // dep
	array_push( $SCRIPT, "effects.js"); // fade out messages etc.

?>
