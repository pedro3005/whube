<?php
	function clean( $ret ) {
		return htmlentities( $ret, ENT_QUOTES);
	}

	$d['errors']  = true;
	$d['message'] = "Unknown Error";

	$ip = $_SERVER['REMOTE_ADDR'];

	include( "conf/site.php" );
	include( "libs/php/globals.php" );

	if ( $ip == $MY_IP ) {

		include( "model/bug.php" );
		include( "model/user.php" );
		include( "model/project.php" );

		$b = new bug();
		$o = new user();
		$p = new project();

		$meta = array();

		foreach ( $_POST as $key => $value ) {
			$meta[clean($key)] = clean($value);
			// fuck you, user
		}

		if (
			isset( $meta['email']   ) &&
			isset( $meta['project'] ) &&
			isset( $meta['title']   ) &&
			isset( $meta['body']   )
		) {
			$o->getByCol( "email", $meta['email'] );
			$submitter = $o->getNext();
			if ( isset ( $submitter['uID'] ) ) { // OK to insert
				$fields = array(
					"reporter" => $submitter['uID'],
					"owner"    => $submitter['uID'],
					"title"    => $meta['title'],
					"descr"    => $meta['body']
				);
				$id = $b->createNew( $fields );

				$d['errors']  = false;
				$d['message'] = "New bug with ID '" + $id + ";";

				if (
					isset ( $meta['assign'] )
				) {
					$o->getByCol( "username", $meta['assign'] );
					$row = $o->getNext();
					if ( isset ( $row['uID'] ) ) {
						$b->updateByPK( $id, array( "owner" => $row['uID'] ) );
						$d['message'] .= "\nAssigning this bug to " . $row['real_name'];
					} else {
						$d['message'] .= "\nCould not find user '" . $meta['assign'] . "' in this DB.";
					}
				}


				if (
					isset ( $meta['project'] )
				) {
					$p->getByCol( "project_name", $meta['project'] );
					$row = $p->getNext();
					if ( isset ( $row['pID'] ) ) {
						$b->updateByPK( $id, array( "package" => $row['pID'] ) );
						$d['message'] .= "\nAssigning this bug to project " . $row['project_name'];
					} else {
						$d['message'] .= "\nCould not find project '" . $meta['project'] . "' in this DB.";
					}
				}

				if (
					isset ( $meta['private'] )
				) {
					$p->getByCol( "private", $meta['private'] );
					if ( $meta['private'] ) {
						$b->updateByPK( $id, array( "private" => true ) );
						$d['message'] .= "\nMarking this bug private";
					} else {
						$b->updateByPK( $id, array( "private" => false ) );
						$d['message'] .= "\nMarking this bug public";
					}

				}

				$d['message'] .= "\n" . $SITE_PREFIX . "t/bug/" . $id;

			} else {
				$d['errors']  = true;
				$d['message'] = "Email ( " . $meta['email'] . " ) Unknown";
			}
/*
			$m = new mailer();
			$m->setTo(       $meta['email'] );
			$m->setSubject(  "Bug Commands Processed" );

$body = "Following are the results from the last whube bug email\n\n";

if ( $d['errors'] ) {
	$body .= "There were errors. The response was: " . $d['message'] . "\n";
} else {
	$body .= "No errors. Response: " . $d['message'] . "\n";
}

$body .= "\nThanks for your bug report!\n\n";
$body .= " -- Whube Bugs\n\n";

			$m->setBody(
				$body
			);
			$m->send();
*/
		} else {
			$d['errors']  = true;
			$d['message'] = "Missing fields!";
		}
	} else {
		$d['errors']  = true;
		$d['message'] = "IP Blacklisted ( " . $ip . " )";
	}


	echo json_encode($d);

?>
