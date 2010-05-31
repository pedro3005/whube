<?php
session_start();
requireLogin();

include( "conf/site.php" );
include( "libs/php/globals.php" );

	if (
isset ( $_POST['project'] ) &&
isset ( $_POST['title']   ) &&
isset ( $_POST['descr']   )
	) {
		include( "model/user.php" );
		include( "model/project.php" );
		include( "model/bug.php" );

		$b = new bug();
		$u = new user();
		$p = new project();

		// let's first verify the project.

		$pname = mysql_real_escape_string( htmlentities( $_POST['project'] ) );
		$title = mysql_real_escape_string( htmlentities( $_POST['title'] ) );
		$descr = mysql_real_escape_string( htmlentities( $_POST['descr'] ) );

		$p->getByCol( "project_name", $pname );

		$project = $p->getNext();

		if ( $project != NULL && $project['pID'] > 0 ) {
			$fields = array(
"package"  => $project['pID'],
"reporter" => $_SESSION['id'],
"title"    => $title,
"descr"    => $descr
			);
			$id = $b->createNew( $fields );
			$_SESSION['msg'] = "New bug created!";
			header("Location: $SITE_PREFIX" . "t/bug/$id");
			exit(0);
		} else {
			$_SESSION['err'] = "Please enter a real project!";
			header("Location: $SITE_PREFIX" . "t/new-bug");
			exit(0);
		}
	} else {
		$_SESSION['err'] = "Please fill in all the forms!";
		header("Location: $SITE_PREFIX" . "t/new-bug");
		exit(0);
	}

?>
