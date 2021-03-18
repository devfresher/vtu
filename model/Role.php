<?php
class Role Extends Utility
{
    public function __construct($db) {
        $this->db = $db;
        $this->table = 'role';
    }

    public function getRole($roleId)
    {
        $result = $this->db->getAllRecords($this->table, "*", "AND id = $roleId");
        
        if(count($result) > 0){
            $feedback = $result[0];
            $this->responseBody = $this->arrayToObject($feedback);
        } else {
            $this->responseBody =  false;
        }
        return $this->responseBody;
    }
}