<?php
class DataOperations {

function saveData($id, $description, $imgpath){
    // save the data in the database
    $db = ConnDatabase::getInstance();
    $mysqli = $db->getConnection(); 
    $sql_query = "INSERT INTO data (id, description, imgpath) VALUES ('$id', '$description', '$imgpath')";
    $result = $mysqli->query($sql_query);
}

function updateData($id, $imgpath){
    // update data if the data already was saved
    $db = ConnDatabase::getInstance();
    $mysqli = $db->getConnection(); 
    $sql_query = "UPDATE data SET imgpath='$imgpath' WHERE id='$id'";
    $result = $mysqli->query($sql_query);
     
}

function retrieveData($id){
    // show data using the id
    $db = ConnDatabase::getInstance();
    $mysqli = $db->getConnection(); 
    $sql_query = "SELECT * FROM data WHERE id='$id'";
    $result = $mysqli->query($sql_query);
    if ($result) {
        /* fetch object array */
        while ($row = $result->fetch_row()) {
            echo  $row[0] ." - " . $row[1] ." - " . $row[2];
        }
        /* free result set */
        $result->close();
    }
    
    /* close connection */
    $mysqli->close();
}
function retrieveAllData(){
    // show data using the id
    $db = ConnDatabase::getInstance();
    $mysqli = $db->getConnection(); 
    $sql_query = "SELECT * FROM data ORDER BY id";
    $result = $mysqli->query($sql_query);
    
    if ($result) {
        /* fetch object array */
        echo "<table>";
        while ($row = $result->fetch_row()) {
            echo "<tr>";
            echo  "<td>".$row[0] ." - " . $row[1] ." </td><td> " . "<img src='".$row[2]."' height=100 width=100></td>";
            echo "</tr>";
        }
        echo "</table>";
        /* free result set */
        $result->close();
    }
    
    /* close connection */
    $mysqli->close();
}




function verifyDataSaved($id){
    // verify if the data was saved already
    // is used to see if we save the data or we only update the imgpath
    $db = ConnDatabase::getInstance();
    $mysqli = $db->getConnection(); 
    $sql_query = "SELECT id FROM data WHERE id='$id'";
    $result = $mysqli->query($sql_query);
    $num_rows = mysqli_num_rows($result);
    
    if ($num_rows>0){ return true;} else {return false;}; 
}

function emptyTable(){
  // update data if the data already was saved
  $db = ConnDatabase::getInstance();
  $mysqli = $db->getConnection(); 
  $sql_query = "TRUNCATE TABLE data";
  $result = $mysqli->query($sql_query);
  
}

}



class ConnDatabase {

    private $_connection;
	private static $_instance; //The single instance
	private $_host = "localhost";
	private $_username = "root";
	private $_password = "";
	private $_database = "pricesearch";
	/*
	Get an instance of the Database
	@return Instance
	*/
	public static function getInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	// Constructor
	private function __construct() {
		$this->_connection = new mysqli($this->_host, $this->_username, 
			$this->_password, $this->_database);
	
		// Error handling
		if(mysqli_connect_error()) {
			trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
				 E_USER_ERROR);
		}
	}
	// Magic method clone is empty to prevent duplication of connection
	private function __clone() { }
	// Get mysqli connection
	public function getConnection() {
		return $this->_connection;
	}    
}





