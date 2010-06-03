<?php
session_start();

include( "model/user.php" );
include( "conf/site.php" );

if ( isset( $_POST['logout'] ) ) {
	session_destroy();
	session_start();
	$_SESSION['msg'] = "See ya' later! I miss ya already!";
	header("Location: " . $SITE_PREFIX . "t/login");
	exit(0);
}

if ( isset( $_POST['login'] ) ) {
	if ( 
		isset( $_POST['name'] ) && $_POST['name'] != "" &&
		isset( $_POST['pass'] ) && $_POST['pass'] != ""
	) {

		$_SESSION['key'] = $_SESSION['token'];
		unset( $_SESSION['token'] );

		$user = new user();
		$user->getByCol( "username", $_POST['name'] );
		$foo = $user->getNext();

		$p_check = md5( $_SESSION['key'] . $foo['password'] );

		if ( $_POST['pass'] == $p_check ) {

			$_SESSION['id']         =   $foo['uID'];
			$_SESSION['real_name']  =   $foo['real_name'];
			$_SESSION['username']   =   $foo['username'];
			$_SESSION['email']      =   $foo['email'];

			$_SESSION['msg'] = "Well done! Welcome in!";
			header("Location: " . $SITE_PREFIX . "t/home");
			exit(0);
		} else {
			$_SESSION['err'] = "Login Failure " . $p_check . ", " . $_POST['pass'];
			header("Location: " . $SITE_PREFIX . "t/login");
			exit(0);
		}
	} else {
		$_SESSION['err'] = "Failed to submit the form completely";
		header("Location: $SITE_PREFIX" . "t/login" );
		exit(0);
	}
}

?>

