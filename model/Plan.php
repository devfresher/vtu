<?php
require_once '../model/Utility.php';
class Plan Extends Utility
{

    public function getPlan($planId)
    {
        if ($this->db->getAllRecords("plan", "*", "AND id = $planId")){

            $result = $this->db->getAllRecords("plan", "*", "AND id = $planId");

            $feedback = $result[0];
            $this->responseBody =  $feedback;
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
    }
}