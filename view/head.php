<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title><?php echo $TITLE; ?></title>
		<link href="<?php echo $SITE_PREFIX; ?>css/default.css" type="text/css" rel="stylesheet" ></link>
	</head>
	<body>
		<div class = "container" >
			<div class = "content" >
<?php

if ( isset( $_SESSION['msg'] ) ) {
	echo "<div class = 'message' >" . $_SESSION['msg'] . "</div>";
	unset( $_SESSION['msg'] );
}

if ( isset( $_SESSION['err'] ) ) {
	echo "<div class = 'error' >" . $_SESSION['err'] . "</div>";
	unset( $_SESSION['err'] );
}

?>
