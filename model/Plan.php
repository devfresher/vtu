<?php

class Plan Extends Utility
{

    public function __construct($db) {
        $this->db = $db;
        $this->table = 'plan';
    }

    public function getPlan($planId)
    {
        if ($this->db->getAllRecords($this->table, "*", "AND id = $planId")){

            $result = $this->db->getAllRecords("plan", "*", "AND id = $planId");

            $feedback = $result[0];
            $this->responseBody =  $feedback;
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
    }
}