<?php
    /*
     *  License:     GPLv3
     *  Author:      Paul Tagliamonte <paultag@whube.com>
     *  Description:
     *    You POST against this file
     */
session_start();

include( "conf/site.php" );
include( "libs/php/globals.php" );

requireLogin();

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

		$pname = htmlentities( $_POST['project'], ENT_QUOTES);
		$title = htmlentities( $_POST['title'],   ENT_QUOTES);
		$descr = htmlentities( $_POST['descr'],   ENT_QUOTES);

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
