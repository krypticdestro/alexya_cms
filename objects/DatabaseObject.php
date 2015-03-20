<?php
/**
 * Database Object
 *
 * This object will be instanced to represent a row from database
 *
 * @author Kryptic Destro
 */
class DatabaseObject {
    /**
     * Array that will contain database's data
     */
    private $data = array();
   
    /**
     * Constructor
     */
    public function __construct($data, $table, $primary_key, $value) {
        if(is_object($data)) {
            $this->data = $data->fetch_assoc();
        } else {
            $this->data = $data;
        }
       
        $this->data["table"] = $table;
        $this->data["primary_key"] = $primary_key;
        $this->data["value"] = $value;
    }

    /**
     * Returns the value of the parameter
     *
     * @param String key: key in the data array
     * @return mixed key's value
     */
    public function __get($key) {
       $default = false;
      
        //Check if key exists in data
        if(isset($this->data[$key])) {
            //send it
            return $this->data[$key];
        } else if($this->value != "") {
            //It doesn't exits, but we have sessionID
            global $Database;

            //Select user's row from database using sessionID as key
            $q = $Database->query("SELECT * FROM $this->table WHERE $this->primary_key=$this->value");

            //check if query succeeded
            if($q && $q->num_rows == 1) {
                //it did
                $this->data = $q->fetch_assoc();

                //check if query contains userID
                if(isset($this->data[$key])) {
                    return $this->data[$key];
                }
            }
        }

        //We couldn't get key
        return $default;
    }

    /**
     * Sets the value of the parameter
     *
     * @param String key: key in the data array
     * @param mixed value: value
     */
    public function __set($key, $value) {
        $this->data[$key] = $value;
    }
   
    /**
     * Saves user to database
     *
     * @return true if succeeded
     */
    public function save()
    {
        global $Database;

        $set = "";

        //Prepare all variables for the query
        foreach($this->data as $key => $value) {
            $val = $value;
            if(is_object($value) || is_array($value)) {
                $val = json_encode($value);
            }
           
            //check if value is string
            if(!is_numeric($val)) {
                //add '
                $set .= ", ".$key."='".$val."'";
            } else {
                $set .= ", " + $key + "=" + $val;
            }
        }

        //delete first ", "
        $set = substr($set, 2);

        //execute query
        $q = $Database->query("UPDATE $this->table SET $set WHERE $this->primary_key=$val");
        //check if succeeded
        if($q && $q->num_rows == 1) {
            return true;
        }
       
        return false;
    }
}