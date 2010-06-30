<?php
	// OVERRIDE THE FOLLOWING IN CODE!
	$CONTENT         = "";       // Default Content
	$TITLE           = "Whube!"; // Default Title
	$SCRIPT          = array();  // Script var
	$PRELOAD         = array();  // Preload vars
	$GUILT_ME        = true;     // The donate banner. ( We're poor )
	$TWEETER         = false;    // Twitter stuff. check conf/twitter.php
	$PIWIK           = false;    // Piwik stats.  Check conf/piwik.php
	$PAGE_MAX_COUNT  = 200;      // max bugs / projects per page.

	array_push( $SCRIPT, "jQuery.js");  // duh
	array_push( $SCRIPT, "effects.js"); // fade out messages etc.
?>
