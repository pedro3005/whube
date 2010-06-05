<?php
include( "model/user.php" );
include( "model/project.php" );
include( "model/bug.php" );

$p = new project();
$b = new bug();
$u = new user();

$u->getByCol( "username", $argv[1] );
$user = $u->getNext();

$p->getAll( "owner", $user['uID'] ); // this is goddamn awesome
$projects = $p->numrows();

$b->getByCol( "package", $user["uID"] ); // this is goddamn awesome
$booboos = $b->numrows();

$critical = 0; // doh // $b->specialSelect( "bug_status != 1" );

if ( isset ( $user["username"] ) ) {
  
  $i=0;
  while( $row = $p->getNext() ) {
    $projectList .= "<li><a href='../project/" . $row['project_name'] . "'>" . $row['project_name'] . "</a></li>";
    $i++;
  }
  
	$TITLE = $user["username"] . ", one of the fantastic users on Whube";
	$CONTENT = "
<h1>" . $user["username"] . "</h1>
This here be " . $user['real_name'] . ".<br />
There are " . $booboos . " bugs filed by " . $user['username'] . ". " . $critical . " are critical.<br />
" . ucwords($user['username']) ." is owner of " . $projects . " projects. These projects are: 
<ul>" . $projectList . "</ul>
";
} else {
	$_SESSION['err'] = "User " . $argv[1] . " does not exist!";
	header( "Location: $SITE_PREFIX" . "t/home" );
	exit(0);
}

?>
