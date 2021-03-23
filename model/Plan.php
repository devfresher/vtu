<?php

class Plan Extends Utility
{

    public function __construct($db) {
        $this->db = $db;
        $this->table = 'plan';
    }

    public function getAllPlans()
    {
        $result = $this->db->getAllRecords($this->table, "*");

        if (count($result) > 0){

            $feedback = $result;
            $this->responseBody =  $this->arrayToObject($feedback);
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
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

    public function createPlan($planData)
    {
        $create = $this->db->insert($this->table, $planData);

        if ($create > 0) {
            $this->responseBody =  true;
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
    }

    public function updatePlan($planData, $planId)
    {
        $update = $this->db->update($this->table, $planData, array('id' => $planId));

        if ($update > 0) {
            $this->responseBody =  true;
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
    }
}