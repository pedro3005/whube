<?php
session_start();

include( "conf/site.php" );
include( "model/user.php" );

	if (
isset ( $_POST['username'] ) &&
isset ( $_POST['realname'] ) &&
isset ( $_POST['email']    ) &&
isset ( $_POST['pass1']    )
	) {
		include( "model/register.php" );
    
		$r = new register();
    $u = new user();

		// let's first verify email and password

    $email    = htmlentities( $_POST['email'], ENT_QUOTES);
    $password = htmlentities( $_POST['pass1'], ENT_QUOTES);
    
    $vemail = $r->validate_email( $email );
    $vpass  = $r->validate_password( $password, 4, 20 ); 
    
    if( $vemail == FALSE ) {
      $_SESSION['err'] = "You ain't trickin' me, pal.  Fix your password.";
      header("Location: $SITE_PREFIX" . "t/register");
      exit(0);
    }
    if( $vpass ) {
      $_SESSION['err'] = "Does your mother know you do that with your password?";
      header("Location: $SITE_PREFIX" . "t/register");
      exit(0);
    }
    
    $u->getByCol( "username", $argv[1] );
    $user = $u->getNext();
    $users = $r->getAllUsers();
    
    $i=0;
    $numUsers = count( $users );

    $vuser = FALSE;
    foreach( $users as $user ) {
      if( $_POST['username'] == $user['username'] ) {
        $_SESSION['err'] = "Hey hey, someone already has that user name.";
        header("Location: $SITE_PREFIX" . "t/register");
      } else {
        $vuser = TRUE;
      }
    }
    

    
    if( $vuser == TRUE ) {
      $locale = explode( ',', $_SERVER['HTTP_ACCEPT_LANGUAGE'] );
      $fields = array(
"real_name" => $_POST['realname'],
"username"  => $_POST['username'],
"email"     => $_POST['email'],
"locale"    => $locale[1],
"timezone"  => $_POST['timezone'],
"password"  => md5($_POST['pass1']) // too plain, not enough salt. :(
      );
      $newuser = $r->createNew( $fields );      
			$_SESSION['msg'] = "There you go, now you just need to log in ;D";
			header("Location: $SITE_PREFIX" . "t/login");
			exit(0);
		} else {
      $_SESSION['err'] = "Please fill in all the forms!";
      header("Location: $SITE_PREFIX" . "t/register");
      exit(0);
    }
	}

?>
