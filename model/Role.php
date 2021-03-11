<?php
class Role Extends Utility
{
    public function getRole($roleId)
    {
        if($result = $this->db->getAllRecords("role", "*", "AND id = $roleId")){

            $feedback = $result[0];
            $this->responseBody =  $feedback;
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
    }
}