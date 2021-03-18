<?php

class Plan Extends Utility
{

    public function __construct($db) {
        $this->db = $db;
        $this->table = 'plan';
    }

    public function getPlan($planId)
    {
        if ($result = $this->db->getAllRecords($this->table, "*", "AND id = $planId")){

            $feedback = $result[0];
            $this->responseBody = $this->arrayToObject($feedback);
        } else {
            $this->responseBody =  false;
        }
        
        return $this->responseBody;
    }
}