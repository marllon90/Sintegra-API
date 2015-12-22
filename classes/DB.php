<?php
class DB {
	private static $_instance = null;
	private $_pdo, $_query, $_error = false, $_results, $_count = 0;
	private function __construct() {
		try {
			$this->_pdo = new PDO ( 'mysql:host=' . Config::get ( 'mysql/host' ) . ';dbname=' . Config::get ( 'mysql/db' ), Config::get ( 'mysql/username' ), Config::get ( 'mysql/password' ) );
		} catch ( PDOException $e ) {
			die ( $e->getMessage () );
		}
	}
	public static function getInstance() {
		if (! isset ( self::$_instance )) {
			self::$_instance = new DB ();
		}
		return self::$_instance;
	}
	public function getFather($table) {
		$sql = "SELECT id FROM {$table} WHERE id = id_pai ORDER BY id DESC LIMIT 1";
		$this->_error = false;
		$this->_query = $this->_pdo->prepare ( $sql );
		if ($this->_query->execute ()) {
			$this->_results = $this->_query->fetchAll ( PDO::FETCH_OBJ );
			$this->_count = $this->_query->rowCount ();
		} else {
			$this->_error = true;
		}
		return $this;
	}
	public function getLastId($table) {
		$sql = "SELECT id FROM {$table} ORDER BY id DESC LIMIT 1";
		$this->_error = false;
		$this->_query = $this->_pdo->prepare ( $sql );
		if ($this->_query->execute ()) {
			$this->_results = $this->_query->fetchAll ( PDO::FETCH_OBJ );
			$this->_count = $this->_query->rowCount ();
		} else {
			$this->_error = true;
		}
		return $this;
	}
	public function getNextId($schema, $table) {
		$sql = "SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$schema' AND TABLE_NAME = '$table'";
		$this->_error = false;
		$this->_query = $this->_pdo->prepare ( $sql );
		if ($this->_query->execute ()) {
			$this->_results = $this->_query->fetchAll ( PDO::FETCH_OBJ );
			$this->_count = $this->_query->rowCount ();
		} else {
			$this->_error = true;
		}
		
		return $this;
	}
	public function error() {
		return $this->_error;
	}
	public function results() {
		return $this->_results;
	}
	public function count() {
		return $this->_count;
	}
	public function first() {
		return $this->results () [0];
	}
	public function query($sql, $params = array()) {
		$this->_error = false;
		if ($this->_query = $this->_pdo->prepare ( $sql )) {
			$i = 1;
			if (count ( $params )) {
				foreach ( $params as $param ) {
					$this->_query->bindValue ( $i, $param );
					$i ++;
				}
			}
			if ($this->_query->execute ()) {
				$this->_results = $this->_query->fetchAll ( PDO::FETCH_OBJ );
				$this->_contador = $this->_query->rowCount ();
			} else {
				$this->_error = true;
			}
		}
		return $this;
	}
	public function insert($table, $fields = array()) {
		if (count ( $fields )) {
			$keys = array_keys ( $fields );
			$values = '';
			$i = 1;
			foreach ( $fields as $field ) {
				$values .= '?';
				if ($i < count ( $fields )) {
					$values .= ', ';
				}
				$i ++;
			}
			$sql = "INSERT INTO {$table} (" . implode ( ', ', $keys ) . ") VALUES ({$values})";
			if (! $this->query ( $sql, $fields )->error ()) {
				return true;
			}
		}
		return false;
	}
	public function get($table, $where) {
		if (isset ( $table ) && isset ( $where )) {
			$sql = "SELECT * FROM $table $where";
			$this->_error = false;
			$this->_query = $this->_pdo->prepare ( $sql );
			if ($this->_query->execute ()) {
				$this->_results = $this->_query->fetchAll ( PDO::FETCH_OBJ );
				$this->_count = $this->_query->rowCount ();
			} else {
				$this->_error = true;
			}
		} else {
			$this->_error = true;
		}
		return $this;
	}
	public function update($table, $id, $fields) {
		$set = '';
		$i = 1;
		foreach ( $fields as $name => $value ) {
			$set .= "{$name} = ?";
			if ($i < count ( $fields )) {
				$set .= ", ";
			}
			$i ++;
		}
		
		$sql = "UPDATE {$table} SET {$set} WHERE id={$id}";
		if (! $this->query ( $sql, $fields )->error ()) {
			return true;
		}
		return false;
	}
	public function sql($query) {
		if (isset ( $query )) {
			$sql = $query;
			$this->_error = false;
			$this->_query = $this->_pdo->prepare ( $sql );
			if ($this->_query->execute ()) {
				$this->_results = $this->_query->fetchAll ( PDO::FETCH_OBJ );
				$this->_count = $this->_query->rowCount ();
			} else {
				$this->_error = true;
			}
		} else {
			$this->_error = true;
		}
		return $this;
	}
}
