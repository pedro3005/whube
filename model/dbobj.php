<?php
    /*
     *  License:     GPLv3
     *  Author:      Paul Tagliamonte <paultag@ubuntu.com>
     *  Description:
     *    DB OBJ class
     */
if ( ! class_exists ( "dbobj" ) ) {

$model_root = dirname(  __FILE__ ) . "/";
  
if ( ! class_exists( "sql" ) ) {
	// last ditch...
	include( $model_root . "sql.php" );
}

include( $model_root . "../conf/sql.php" );

class dbobj {
	var $sql;
	var $table;
	var $pk_field;

	function dbobj( $table, $pk_field ) {
    global $TABLE_PREFIX;
		$this->table     = $TABLE_PREFIX.$table;
		$this->pk_field  = $pk_field;
		$this->sql       = new sql();
	}

	function getAll() {
		$this->sql->query( "SELECT * FROM " . $this->table . " ORDER BY " . $this->pk_field . " DESC" );
	}

	function createNew( $items ) {
		// key => value
		$keys = "";
		$values = "";
		foreach ( $items as $key => $value ) {
			if ( ! is_numeric( $value ) ) {
				$value = "'$value'";
			} 
			if ( $keys != "" ) { $keys .= ", "; }
			$keys .= $key;

			if ( $values != "" ) { $values .= ", "; }
			$values .= $value;
		}
		$this->sql->query( "INSERT INTO " . $this->table . " ( " . $keys . " ) VALUES ( " . $values . " );" );
		$ID = $this->sql->getLastID();
		$this->sql->query( "UPDATE " . $this->table . " SET trampstamp=" . time() . " WHERE " . $this->pk_field . "=" . $ID . " ;" );
		return $ID;
	}

	function updateByPK( $PK, $tables ) {
		$QUERY = "UPDATE " . $this->table . " SET ";
		$nipflipflip = false;
		foreach ( $tables as $key => $value ) {
			if ( ! is_numeric( $value ) ) {
				$value = "'$value'";
			}
			if ( $nipflipflip ) {
				$QUERY .= ", ";
			} else {
				$nipflipflip = true;
			}
			$QUERY .= $key . " = " . $value;
		}
		$QUERY .= " WHERE " . $this->pk_field . " = '" . $PK . "';";
		$this->sql->query( $QUERY );
		$this->sql->query( "UPDATE " . $this->table . " SET trampstamp=" . time() . " WHERE " . $this->pk_field . "=" . $PK . ";" );
	}

	function specialSelect($query ) {
		$this->sql->query( "SELECT * FROM " . $this->table . " WHERE " . $query . ";" );
		return $this->numrows();
	}

	function getAllByPK( $pk ) {
		$this->sql->query( "SELECT * FROM " . $this->table . " WHERE " . $this->pk_field . " = '" . $pk . "'; " );
	}
	function getByCol( $cID, $id ) {
                $this->sql->query( "SELECT * FROM " . $this->table . " WHERE " . $cID . " = '" . $id . "'; " );
	}
	function searchByKey( $cID, $id ) {
                $this->sql->query( "SELECT * FROM " . $this->table . " WHERE " . $cID . " LIKE '%" . $id . "%'; " );
	}
	function numRows() {
		return $this->sql->numrows();
	}
	function getNext() {
		return $this->sql->getNextRow();
	}

}

}
?>
