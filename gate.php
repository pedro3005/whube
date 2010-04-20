<?php
session_start();

include( "model/sql.php" );   // move this to dbobj
include( "model/dbobj.php" ); // move this to user
include( "model/user.php" );

if ( isset( $_POST['login'] ) ) {
	if ( 
		isset( $_POST['name'] ) && $_POST['name'] != "" &&
		isset( $_POST['pass'] ) && $_POST['pass'] != ""
	) {
		$user = new user();

		$user->getAll();

		while ( $foo = $user->getNext() ) {
			echo $foo['name'];
		}

	} else {
		$_SESSION['err'] = "Failed to submit the form completely";
		header("Location: $SITE_PREFIX");
		exit(0);
	}
}

?>
