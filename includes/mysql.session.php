<?php
class Session {
	private $db;

	public function __construct($db){
		// Instantiate new Database object
		$this->db = $db;

		// Set handler to overide SESSION
		session_set_save_handler(
		array($this, "_open"),
		array($this, "_close"),
		array($this, "_read"),
		array($this, "_write"),
		array($this, "_destroy"),
		array($this, "_gc")
		);

		// Start the session
		session_start();
	}
	public function _open(){
		// If successful
		if($this->db){
            // Return True
            return true;
		}
		// Return False
		return false;
	}
	public function _close(){
		// Close the database connection
		// If successful
		if($this->db->close()){
            // Return True
            return true;
		}
		// Return False
		return false;
	}
	public function _read($id){
		// Set query
		$row = $this->db->getAllRecords('sessions', 'data', "AND id = '$id'");

		// If successful
		if(count($row) > 0){
            // Return the data
            return $row[0]['data'];
		}else{
            // Return an empty string
            return '';
		}
	}
	public function _write($id, $data){
		// Create time stamp
		$access = time();

		// Set query  
		$insert = $this->db->insert("sessions", array('id' => $id, 'access' => $access, 'data' => $data ));

		// If successful
		if($insert > 0){
            // Return True
            return true;
		}
		// Return False
		return false;
	}
	public function _destroy($id){
		// Set query
		$delete = $this->db->delete("sessions", array('id' => $id));

		if($delete > 0){
            // Return True
            return true;
		}
		// Return False
		return false;
	} 
	public function _gc($max){
		// Calculate what is to be deemed old
		$old = time() - $max;

		// Set query
		$delete = $this->db->delete2("DELETE FROM sessions WHERE access < '$old'");

		if($delete > 0){
            // Return True
            return true;
		}
		// Return False
		return false;
	}
}
?>