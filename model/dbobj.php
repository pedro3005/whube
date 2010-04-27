<?php

class dbobj {
	var $sql;
	var $table;
	var $pk_field;

	function dbobj( $table, $pk_field ) {
		$this->table     = $table;
		$this->pk_field  = $pk_field;
		$this->sql       = new sql();
	}

	function getAll() {
		$this->sql->query( "SELECT * FROM " . $this->table );
	}

	function getByID( $name ) {
		$this->sql->query( "SELECT * FROM " . $this->table . " WHERE " . $this->pk_field . " = '" . $name . "';" );
	}

	function getNext() {
		return $this->sql->getNextRow();
	}

}

?>
