<?php
class Role Extends Utility
{
    public function __construct($db) {
        $this->db = $db;
        $this->table = 'role';
    }

    public function getRole($roleId)
    {
        if($result = $this->db->getAllRecords($this->table, "*", "AND id = $roleId")){

            $feedback = $result[0];
            $this->responseBody =  $feedback;
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
    }
}