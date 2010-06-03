<?php
session_start();

include( "conf/site.php" );
include( "libs/php/globals.php" );

requireLogin();

include( "model/bug.php" );
include( "model/user.php" );
include( "model/project.php" );

$b = new bug();

function clean( $ret ) {
	return htmlentities( $ret, ENT_QUOTES);
}

/*

 --> get shiz via $_POST all like:

Array (
	[bID] => 1
	[project] => whube_docs
	[title] => Whube is not done yet
	[status] => 1
	[severity] => 1
	[owner] => raidsong
)
 
*/

// print_r( $_POST ); // data sent to us

$bugid   = clean($_POST['bID'] );       /* Bug ID. This should NEVER be fucked with */
$project = clean($_POST['project']);    /* New project of the bug ( perhaps )  */
$title   = clean($_POST['title']);      /* New title of the bug ( perhaps )    */
$status  = clean($_POST['status']);     /* New status of the bug ( perhaps )   */
$sever   = clean($_POST['severity']);   /* New severity of the bug ( perhaps ) */
$owner   = clean($_POST['owner']);      /* New owner of the bug ( perhaps )    */
$descr   = clean($_POST['descr']);      /* New descr of the bug ( perhaps )    */

$o = new user();
$p = new project();

$o->getByCol( "username",     $owner );
$p->getByCol( "project_name", $project );

$own = $o->getNext();
$pkg = $p->getNext();

$projectID = $pkg['pID'];
$ownerID   = $own['uID'];

$posted_data = array(
	"bug_severity" => $sever,
	"bug_status"   => $status,
	"package"      => $projectID,
	"owner"        => $ownerID,
	"title"        => $title,
	"descr"        => $descr
);


// print_r( $posted_data );

$b->getAllByPK( $bugid );
$row = $b->getNext();

// print_r( $row ); // searched bug

/*
 --> $row should look like:

   ** NOTE: IGNORE THE [n] ETC! THEY ARE STUPID IF YOU DON'T QUERY FUR THEM **

Array (
	[bID] =>              1                        <-- PK, bug ID
	[bug_status] => 1                              <-- FK, status table by ID
	[bug_severity] => 1                            <-- FK, severity table by ID
	[package] => 1                                 <-- FK, project table by pID
	[reporter] => 1                                <-- FK, user table by uID
	[owner] => 0                                   <-- FK, user table by uID
	[title] => Whube is not done yet               <-- Title
	[descr] => Whube is not done yet, of course!   <-- Description
)

*/

$b->updateByPK( $bugid, $posted_data );

// /*

$_SESSION['msg'] = "Bug #$bugid updated!";
header( "Location: " . $SITE_PREFIX . "t/bug/" . $bugid );
exit(0);

// */

?>
