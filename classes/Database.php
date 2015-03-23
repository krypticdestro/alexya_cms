<?php
/**
 * DataBase object
 *
 * This object will be used to load all data from database
 *
 * @author Kryptic Destro
 */
class Database extends mysqli
{
	/**
	 * Last query executed
	 */
	public $last_query;
	
	/**
	 * Constructshit
	 *
	 * @param string host: database host
	 * @param string user: user??? YESSS!!!! BINGO!!
	 * @param string pass: user password
	 * @param string database: database to connect
	 * @param int port: mysql port
	 * @param mixed socket: idk why I put this shit xD
	*/
	public function __construct($host = 'localhost', $user = 'root', $pass = '',
								$db = "", $port = 3306, $socket = null)
	{
		// execute parent constructor that will try to connect,
		// use @ operator, to supress any error output
		@parent::__construct($host, $user, $pass, $db, $port, $socket);
		// check if connect errno is set
		if ($this->connect_errno != 0){
			throw new Exception($this->connect_error, $this->connect_errno);
		}
	}
	
	/**
	 * Returns an array of rows from databaaaaaseeeee
	 *
	 * @param string key: table to get rows
	 * @param string extra: special sql shit, like WHERE, DISTINCT...
	 * @param int limit: max length of array, -1 = infinite >:)
	 * @param string objectType: if null the array will be filled with rows as array, otherwhise it will be filled with that object
	*/
	public function get($key, $extra = null, $limit = -1, $objectType = null)
	{
		//Check if extra SQL is setted
		if($extra != null) {
			$e = " ".$extra;
		} else {
			$e = "";
		}

		//Check if limit is setted
		if($limit >= 0) {
			$l = " LIMIT $limit";
		} else {
			$l = "";
		}
		
		//Build and execute the query:
		/*
		 * First build the query with the given parameters
		 * Then build an array in which will be saved the rows
		 * Add all rows from the query to the array
		 * If user choose a custom objectType
		 *		The array will be filled with that object type
		 * else
		 *		It will be filled with the "query::fetch_assoc()" result
		 */
		$eval = '$query = "SELECT * FROM '.$key.$e.$l.'";
		         $q = $this->query($query) or die($this->error."<br/>".$query);
		         $ret = array();
		
		         if($q) {
			        while($row = $q->fetch_assoc()) {';
		if($objectType != "") {
			$eval .= '$ret[$row["'.$this->getID($key).'"]] = new '. $objectType .'($row);';
		} else {
			$eval .= '$ret[$row["'.$this->getID($key).'"]] = $row;';
		}
		$eval .= '}
		         }';
		eval($eval);
		
		//Return the resulting array
		return $ret;
	}

 	/**
 	 * Returns the name of the primary key
 	 *
 	 * @param string key: name of the table
 	 * @return string primary key of table
 	*/
	public function getID($key)
	{
		$array = array(
			"users"			=> "userID",
			"comments"		=> "commentID",
			"posts"			=> "postID",
			"categories"	=> "categoryID",
			"menu"			=> "itemID",
		);
		if(isset($array, $key)) {
			return $array[$key];
		} else {
			if(DEBUG) {
				Results::addFlash(array(
							"result"  => "error",
							"message" => "Couldn't get $key from the array at Database::getID(string)"
						));
			}
		}
	}
	
	/**
	 * Returns an object from database
	 *
	 * @param string table: table name
	 * @param string id: primary key value
	 * @param objectType: object to return, by default: DatabaseObject
	 * @return especified object if succeed, error if not
	*/
	public function getObject($table, $id, $objectType = "DatabaseObject")
	{
		//escape the parameters
		$table = $this->real_escape_string($table);
		$id    = $this->real_escape_string($id);
		
		//Build query
		$query = "SELECT * FROM `$table` WHERE ".$this->getID($table)."=$id";
		
		$ret = false;
		$q = $this->query($query)
				or $ret = $this->error;
		//Check if query succeed
		if($q && $q->num_rows == 1) {
			$q = $q->fetch_assoc();
			
			//If user wants an array as result
			if($objectType == "array") {
				return $q;
			} else {
				//Else instance and result a new object type
				if($objectType == "DatabaseObject") {
					$ret = new DatabaseObject($q, $table, $this->getID($table), $id);
				} else {
					$ret = new $objectType($q);
				}
			}
		}

		return $ret;
	}
	
	/**
	 * Inserts a row in database
	 *
	 * @param string table: table name
	 * @param array variables: same as update function, too lazy to write more shit that just a psychopath (aka me) will read
	 * @return true if succeede, error if not
	*/
	public function insert($table, $variables)
	{
		$table = $this->real_escape_string($table);
		$rows  = "";
		$values = "";
		
		foreach($variables as $key => $value) {
			$rows .= "`$key`,";
			if(is_string($value)) {
				$values .= "'".$this->real_escape_string($value)."',";
			} else if(is_object($value) || is_array($value)) {
				$values .= "'".$this->real_escape_string(json_encode($value))."',";
			} else {
				$values .= $value.',';
			}
		}
		
		$rows = substr($rows, 0, -1);
		$values = substr($values, 0, -1);
		
		$query = "INSERT INTO `$table` ($rows) VALUES ($values)";
		
		$ret = false;
		$q = $this->query($query)
				or $ret = $this->error;
		if($q == true) {
			return $this->insert_id;
		}
		
		return $ret;
	}
	
	/**
	 * Updates a row in database
	 * 
	 * @param string table: table name
	 * @param array variables: name of cols to update (key = col name, value = ... value? YES! Value!!)
	 * @param string id: primary key value
	 * @return true if succeed, error if not
	*/
	public function update($table, $variables, $id)
	{
		$table = $this->real_escape_string($table);
		$id    = $this->real_escape_string($id);
		$set = "";
		
		foreach($variables as $key => $value) {
			$set .= "`$key`=";
			if(is_string($value)) {
				$set .= "'".$this->real_escape_string($value)."'";
			} else if(is_object($value) || is_array($value)) {
				$set .= "'".$this->real_escape_string(json_encode($value))."'";
			} else {
				$set .= $value;
			}
			
			$set .= ", ";
		}
		
		$set = substr($set, 0, -2);
		
		$query = "UPDATE `$table` SET $set WHERE ".$this->getID($table)."=$id";
		
		$ret = false;
		$q = $this->query($query)
				or $ret = $this->error;
		if($q == true) {
			return true;
		}
		
		return $ret;
	}
	
	/**
	 * Deletes a row in database
	 *
	 * @param string table: table name
	 * @param mixed id: can be array or string, if string it will be the value of primary key (I understand myself ok?)
	 * @return true if succed, error if not
	*/
	public function delete($table, $id)
	{
		$table = $this->real_escape_string($table);
		if(is_array($id)) {
			$where = "";
			
			foreach($id as $key => $value) {
				$where .= "`$key`=";
				if(is_string($value)) {
					$where .= "'".$this->real_escape_string($value)."'";
				} else if(is_object($value) || is_array($value)) {
					$where .= "'".$this->real_escape_string(json_encode($value))."'";
				} else {
					$where .= $value;
				}
				
				$where .= " AND ";
			}
			
			$where = substr($where, 0, -5);
		} else {
			$where = $this->getID($table)."=".$this->real_escape_string($id);
		}
		
		$query = "DELETE FROM `$table` WHERE ".$where;
		
		$ret = false;
		$q = $this->query($query)
				or $ret = $this->error;
		if($q == true) {
			return true;
		}
		
		return $ret;
	}
	
	/**
	 * Returns num_rows of given query
	 * 
	 * @param string query Query to execute
	 * @return int number of rows affected
	 * @throws Exception
	*/
	public function getNumRows($query)
	{
		$q = $this->query($query);
		
		if($this->errno != 0) {
			throw new Exception("Couldn't get num_rows: $query");
		}
		
		return $q->num_rows;
	}
	
	/**
	 * Query method
	 *
	 * @param string $sql SQL to execute
	 * @return mysqli_result Object
	 * @throws DBQueryException
	*/
	public function query($sql)
	{
		$this->last_query = $sql;
		
		$result = @parent::query($sql);
		// check if errno is set
		if ($this->errno != 0){
			throw new Exception($this->error ." Query: ".$sql, $this->errno);
		}

		return $result;
	}
}