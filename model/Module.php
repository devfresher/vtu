<?php
class Module Extends Utility
{
    public function __construct($db) {
        $this->db = $db;
        $this->table = 'modules';
    }

    public function getAllModules($group = '')
    {
        if ($group == '') {
            $result = $this->db->getAllRecords($this->table, "*");
        } else {
            $result = $this->db->getAllRecords($this->table, "*", " AND module_group = '$group'");
        }

        if (count($result) > 0){

            $feedback = $result;
            $this->responseBody =  $this->arrayToObject($feedback);
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
    }

    public function getAdminModules($group = '')
    {
        if ($group == '') {
            $result = $this->db->getAllRecords($this->table, "*", "AND type = 'admin'");
        } else {
            $result = $this->db->getAllRecords($this->table, "*", " AND module_group = '$group' AND type = 'admin'");
        }

        if (count($result) > 0){

            $feedback = $result;
            $this->responseBody =  $this->arrayToObject($feedback);
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
    }

    public function getModule($moduleId)
    {
        $result = $this->db->getAllRecords($this->table, "*", "AND id = $moduleId");
        
        if(count($result) > 0){
            $feedback = $result[0];
            $this->responseBody = $this->arrayToObject($feedback);
        } else {
            $this->responseBody =  false;
        }
        return $this->responseBody;
    }
}