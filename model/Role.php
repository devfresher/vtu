<?php
class Role Extends Utility
{
    public function __construct($db) {
        $this->db = $db;
        $this->table = 'role';
    }

    public function createRole($roleData)
    {
        $this->db->beginTransaction();
        try {
            
            $createRole = $this->db->insert($this->table, $roleData);
                        
            if ($createRole) {
                $this->responseBody =  true;
                $this->db->commit();
            } else {
                $this->responseBody =  false;
                $this->db->rollback();
            }
        } catch (Exception $e) {
            $this->db->rollback();
            $this->responseBody =  false;
            echo $e->getMessage();
        }

        return $this->responseBody;
    }

    public function getAllRoles()
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

    public function deleteRole($roleId)
    {
        $roleDetail = $this->getRole($roleId);
        print_r($roleDetail);

        $this->db->beginTransaction();
        try {
            if ($roleDetail->role_code == 'SUPERADMIN') {
                return false;
            } else {
                $this->db->delete($this->table, array('id' => $roleId));
                $this->db->commit();
        
                return true;
            }
    
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
            echo $e->getMessage();
        }
    }

    public function updateRole($roleData, $roleId)
    {
        $update = $this->db->update($this->table, $roleData, array('id' => $roleId));

        if ($update > 0) {
            $this->responseBody =  true;
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
    }
}