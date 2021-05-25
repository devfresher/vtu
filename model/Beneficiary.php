<?php
require_once MODEL_DIR.'Utility.php';

class Beneficiary Extends Utility
{

    public function __construct($db) {
        $this->db = $db;
        $this->table = 'beneficiary';
    }

    public function getAllBeneficiaries()
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

    public function getUserBeneficiaries($userId)
    {
        if ($result = $this->db->getAllRecords($this->table, "*", "AND user_id = $userId")){

            $feedback = $result;
            $this->responseBody = $this->arrayToObject($feedback);
        } else {
            $this->responseBody =  false;
        }
        
        return $this->responseBody;
    }

    public function getBeneficiary($phoneNumber, $userId)
    {
        if ($result = $this->db->getAllRecords($this->table, "*", " AND phone_number = '$phoneNumber' AND user_id = $userId")){

            $feedback = $result[0];
            $this->responseBody = $this->arrayToObject($feedback);
        } else {
            $this->responseBody =  false;
        }
        
        return $this->responseBody;
    }

    public function create($beneficiaryData)
    {
        $beneficiaries = $this->getBeneficiary($beneficiaryData['phone_number'], $beneficiaryData['user_id']);  
        
        if ($beneficiaries == false OR $beneficiaries == '') {
            $this->db->beginTransaction();
            try {
                
                $createBeneficiary = $this->db->insert($this->table, $beneficiaryData);
                
                if ($createBeneficiary ) {
                    $this->responseBody =  true;
                    $this->db->commit();
                }
            } catch (Exception $e) {
                $this->db->rollback();
                $this->responseBody =  false;
                // echo $e->getMessage();
            }
        } else {
            $this->responseBody =  false;
        }


        return $this->responseBody;
    }

    public function updateBeneficiary($beneficiaryData, $benId)
    {
        $update = $this->db->update($this->table, $beneficiaryData, array('id' => $benId));

        if ($update > 0) {
            $this->responseBody =  true;
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
    }
}