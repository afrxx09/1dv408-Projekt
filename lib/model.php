<?php

class Model{
	protected $table;
	
	public $hasOne = array();
	public $hasMany = array();
	public $belongsTo = array();
	
	public function __construct($table){
		$this->table = $table;
	}
	
	public function __set($key, $val){
		$this->{$key} = $val;
	}
	
	public function __get($key){
		return (isset($this->{$key})) ? $this->{$key} : null;
	}
	
	protected function connection(){
		if($this->dbConnection == null){
			$this->dbConnection = new \PDO('mysql:host=' . \Config::DB_HOST . ';dbname=' . \Config::DB_NAME, \Config::DB_USERNAME, \Config::DB_PASSWORD);
			if(\Config::DEBUG){
				$this->dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			}
		}
		return $this->dbConnection;
	}
	
	public function find($id, $column = 'id'){
		$sql = "
			SELECT " . $this->table . ".*
			FROM " . $this->table . "
			WHERE ". $this->table ."." . $column . " = :value
		";
		$params = array(":value" => $id);
		return $this->query($sql, $params);
	}
	
	public function first($id, $column = 'id'){
		$result = $this->find($id, $column);
		return $result[0];
	}
	
	public function all(){
		$sql = "
			SELECT " . $this->table . ".*
			FROM " . $this->table . "
		";
		return $this->query($sql);
	}

	protected function query($sql, $params = null, $insert = false){
		$db = $this->connection();
		$query = $db->prepare($sql);

		if($params !== null){
			if (!is_array($params)){
				$params = array($params);
			}
			$query->execute($params);
		}
		else{
			$query->execute();
		}

		if($insert){
			return true;
		}
		if($response = $query->fetchAll(PDO::FETCH_CLASS)){
			return $response;
		}
		return null;
	}
}