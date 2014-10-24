<?php

/**
*	Base model class
*	Generic business logic functions and datebase interaction	
*/
class Model{
	protected $dbConnection;
	protected $table;
	
	/** arrays used by extended models to specify association */
	public $hasOne = array();
	public $hasMany = array();
	public $belongsTo = array();
	
	public function __construct($table){
		$this->table = $table;
	}
	
	/**
	*	Override of __set method, used to set named attributes dynamically in model objects. Main purpose is to be able to add associated models
	*	@param string $key, name of attribute
	*	@param mixed $val, value of that attribute 
	*/
	public function __set($key, $val){
		$this->{$key} = $val;
	}
	
	/**
	*	Override __get method to be able to access dynamically added attributes
	*	@param string $key, name of attribute to access
	*/
	public function __get($key){
		return (isset($this->{$key})) ? $this->{$key} : null;
	}
	
	/**
	*	Get PDO connection object
	*	@return PDO connection
	*/
	protected function connection(){
		if($this->dbConnection == null){
			$this->dbConnection = new \PDO('mysql:host=' . \Config::DB_HOST . ';dbname=' . \Config::DB_NAME, \Config::DB_USERNAME, \Config::DB_PASSWORD);
			if(\Config::DEBUG){
				$this->dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			}
		}
		return $this->dbConnection;
	}
	
	/**
	*	Check array keys to make sure it only contains allowed data declared by optional $allowedFields array in model-class
	*	@param model array
	*	@return array
	*/
	public function check(&$model){
		$validFields = array();
		if(isset($this->allowedFields) && !empty($this->allowedFields)){
			foreach($model as $key => $value){
				if(in_array($key, $this->allowedFields)){
					$validFields[$key] = $value;
				}
				else{
					//throw new \Exception('Post contains unallowed field: ' . $key);
				}
			}
			$model = $validFields;
		}
	}
	
	/**
	*	Find posts in database by given conditions
	*	@param mixed $id, identifer to compare posts with
	*	@param string $column (optional), what column to use for comparison. Normally the "id"-column
	*	@return array $stdClass
	*/
	public function find($id, $column = 'id'){
		$sql = "
			SELECT " . $this->table . ".*
			FROM " . $this->table . "
			WHERE ". $this->table ."." . $column . " = :value
		";
		$params = array(":value" => $id);
		return $this->query($sql, $params);
	}
	
	/**
	*	Same as find but only returns one post
	*	@return object $stdClass
	*/
	public function one($id, $column = 'id'){
		$result = $this->find($id, $column);
		return $result[0];
	}
	
	/**
	*	Get all posts from model table
	*	@return array $stdClass
	*/
	public function all(){
		$sql = "
			SELECT " . $this->table . ".*
			FROM " . $this->table . "
		";
		return $this->query($sql);
	}
	
	/**
	*	Create a new post in database for corresponding table. Converts stdClass-object to array to iterate through and build variables needed to execute
	*	@param stdClass $model, model-object to insert
	*	@return bool, if insert was successful or not
	*/
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
	
	/**
	*	Update exsisting post in database using a stdClass-model object 
	*	@param stdClass $model, model-object to update
	*	@return bool, if update was successful or not
	*/
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
	
	/**
	*	Delete existing post in databse using stdClass-model object
	*	@param stdClass $model, model-object to delkete
	*	@return bool, if delete was successful or not
	*/
	public function delete($model){
		$sql = "
			DELETE FROM " . $this->table . "
			WHERE " . $this->table . ".id = :id
		";
		$params = array(':id' => $model->id);
		return $this->query($sql, $params, true);
	}
	
	/**
	*	Generic query method to execute database operations
	*	@param string $sql, sql-query to be executed
	*	@param array $params, parameters for execution of query
	*	@param bool $insert, wether or not to return boolean of successful operation or array of stdObjects 
	*	@return mixed, boolean for insert-type querys and array of stdObjects for fetch-type querys
	*/
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
		if($response = $query->fetchAll(PDO::FETCH_OBJ)){
			return $response;
			/** Want to add variable type convertion since PDO always returns string values */
			//return ($response !== null) ? $this->setTypes($response, $query) : null;
		}
		return null;
	}
	
	/**
	*	Simply making a query with a sql and returning the result
	*	@param string $sql, sql to be exeuted
	*	@return array, query result-set
	*/
	public function sql($sql){
		$db = $this->connection();
		$query = $db->prepare($sql);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	
	/*
	public function setTypes($response, $query){
		foreach($response as $row){
			$i = 0;
			foreach($row as $field){
				$meta = $query->getColumnMeta($i);
				$field->{$meta['name']} = $this->getTypeVar($meta['native_type'], $field->{$meta['name']});
				$i++;
			}
		}
		var_dump($response);
		exit;
	}
	
	private function getTypeVar($nativeType, $var){
		$ints = array('TINY', 'SHORT', 'LONG', 'INT24', 'LONGLONG');
		$floats = array('DECIMAL', 'FLOAT', 'DOUBLE');
		if(in_array(strtoupper($nativeType), $ints)){
			return intval($var);
		}
		elseif(in_array(strtoupper($nativeType), $floats)){
			return floatval($var);
		}
		return $var;
	}
	*/
}