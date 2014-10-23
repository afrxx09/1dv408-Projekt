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
	
	public function one($id, $column = 'id'){
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
	
	public function create($model){
		//$validator = new \Validator();
		//$valid = $validator->validate($this, $model);
		$modelArray = get_object_vars($model);
		$fields = '';
		$paramKeys = '';
		$params = array();
		foreach($modelArray as $key => $value){
			$fields .= $key . ',';
			$paramKeys .= ':' . $key . ',';
			$params[':' . $key] = $value;
		}
		$fields = rtrim($fields, ',');
		$paramKeys = rtrim($paramKeys, ',');
		$sql = "
			INSERT INTO " . $this->table . "(" . $fields . ")
			VALUES (" . $paramKeys . ")
		";
		return $this->query($sql, $params, true);
	}
	
	public function save($model){
		//$validator = new \Validator();
		//$valid = $validator->validate($this, $model);
		$modelArray = get_object_vars($model);
		$fields = '';
		$params = array();
		foreach($modelArray as $key => $value){
			if($key !== 'id'){
				$fields .= $key . ' = :' . $key .',';
			}
			$params[':' . $key] = $value;
		}
		$fields = rtrim($fields, ',');
		$sql = "
			UPDATE " . $this->table . "
			SET " . $fields . "
			WHERE " . $this->table . ".id = :id
		";
		return $this->query($sql, $params, true);
	}
	
	public function delete($model){
		$sql = "
			DELETE FROM " . $this->table . "
			WHERE " . $this->table . ".id = :id
		";
		$params = array(':id' => $model->id);
		return $this->query($sql, $params, true);
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
	
	public function check(&$model){
		$validFields = array();
		if(isset($this->allowedFields)){
			foreach($model as $key => $value){
				if(in_array($key, $this->allowedFields)){
					$validFields[$key] = $value;
				}
				else{
					//throw new \Exception('Post contains unallowed field: ' . $key);
				}
			}
		}
		$model = (object)$validFields;
	}
}