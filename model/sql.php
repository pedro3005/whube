<?php
    /*
     *  License:     GPLv3
     *  Author:      Paul Tagliamonte <paultag@ubuntu.com>
     *  Description:
     *    MySQL interface class.
     */

if ( ! class_exists ( "sql" ) ) {
class sql {

	var $link;
	var $result;

	function __construct() {
		$path = dirname(__FILE__) . "/";
		include( $path . "../conf/sql.php" );
		$this->connect( $mysql_host, $mysql_user, $mysql_pass, $mysql_data );
	}
	function __destruct() {
		$this->destruct();
	}
	function destruct() {
		// mysql_close( $this->link );
	}
	function connect( $host, $name, $pass, $db ) {
		$this->link = mysql_connect(
			$host,
			$name,
			$pass
		) or die( mysql_error() );
		mysql_select_db( $db ) or die( mysql_error() ); // Lets get our Database
	}
	function getNextRow() {
		if ( $this->result != NULL ) {
			if ( $row = mysql_fetch_array( $this->result ) ) {
				return $row;
			} else {
				return NULL;
			}
		} else {
			return NULL;
		}
	}
	function numrows() {
		return mysql_num_rows($this->result);
	}
	function getLastID() {
		return mysql_insert_id( $this->link );
	}
	function query( $query ) {
		$this->result = mysql_query($query) or die( mysql_error() );  // Preform the Query.
	}
}
}
?>
