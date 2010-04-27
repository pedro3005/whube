<?php
session_start();

include( "model/sql.php" );   // move this to dbobj
include( "model/dbobj.php" ); // move this to user
include( "model/user.php" );

if ( isset( $_POST['logout'] ) ) {
	session_destroy();
	session_start();
	$_SESSION['msg'] = "See ya' later! I miss ya already!";
	header("Location: $SITE_PREFIX/t/login");
	exit(0);
}

if ( isset( $_POST['login'] ) ) {
	if ( 
		isset( $_POST['name'] ) && $_POST['name'] != "" &&
		isset( $_POST['pass'] ) && $_POST['pass'] != ""
	) {
		$user = new user();
		$user->getByID( "paultag" );
		$foo = $user->getNext();

		if ( $_POST['pass'] == $foo['passwd'] ) {

			$_SESSION['id']         =   $foo['uID'];
			$_SESSION['real_name']  =   $foo['real_name'];
			$_SESSION['email']      =   $foo['email'];
			$_SESSION['lang']       =   $foo['lang'];

			$_SESSION['msg'] = "Well done! Welcome in!";
			header("Location: $SITE_PREFIX/t/home");
			exit(0);
		} else {
			$_SESSION['err'] = "Login Failure";
			header("Location: $SITE_PREFIX/t/login");
			exit(0);
		}
	} else {
		$_SESSION['err'] = "Failed to submit the form completely";
		header("Location: $SITE_PREFIX");
		exit(0);
	}
}

?>
