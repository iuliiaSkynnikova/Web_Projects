<?php
class DBConnect{
	private $_DSN;
	private $_userName;
	private $_password;
	private $_conn;

	public function __construct($DSN, $userName, $password){
		$this->_DSN = $DSN;
		$this->_userName = $userName;
		$this->_password = $password;
	}

	public function connect(){
		try{
			$this->_conn = new PDO($this->_DSN, $this->_userName, $this->_password);
			$this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $this->_conn;
		}
		catch (PDOException $e){
			die("Connection failed: " . $e->getMessage());
		}
	}

	public function disconnect(){
		 $this->_conn = "";
	}

	public function executeSQL($sql){
		try{
			$rows = $this->_conn->query($sql);
		}
		catch(PDOException $e){
			die("Query failed: " . $e->getMessage());
		}
		return $rows;
	}

	public function executeSQLReturn1($sql){
		try{
			$row = $this->_conn->query($sql);
			$value = $row->fetch();
		}
		catch(PDOException $e){
			die("Query failed: " . $e->getMessage());
		}
		return $value;

	}
}
?>