<?php
require_once MODEL_DIR.'Module.php';

class Role Extends Utility
{
    public function __construct($db) {
        $this->db = $db;
        $this->table = 'role';
        $this->table2 = 'role_permission';
    }

    public function createRole($roleData)
    {
        $this->db->beginTransaction();
        try {
            
            $createRole = $this->db->insert($this->table, $roleData);
            $roleId = $this->db->lastInsertId();
            
            $createRolePermission = $this->createRolePermission($roleId);
                        
            if ($createRole > 0 AND $createRolePermission > 0) {
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

    public function createRolePermission($roleId)
    {
        $module = new Module($this->db);
        $aminModules = $module->getAdminModules();

        $permissionData = array();
        $i = 0;
        foreach ($aminModules as $moduleItem) {
            $permissionData[$i]['module_id'] = $moduleItem['id'];
            $permissionData[$i]['role_id'] = $roleId;
            $permissionData[$i]['view'] = 0;
            $permissionData[$i]['create_new'] = 0;
            $permissionData[$i]['edit'] = 0;
            $permissionData[$i]['del'] = 0;

            $i++;
        }

        try {
             $this->db->delete2("DELETE FROM ".$this->table2." WHERE role_id = ".$roleId."");

            if (isset($permissionData) && !empty($permissionData)) {
                $this->db->multiInsert($this->table2, $permissionData);
                $this->responseBody =  true;
            }
        } catch (Exception $e) {
            $this->responseBody =  false;
            echo $e->getMessage();
        }

        return $this->responseBody;
    }

    public function updatePermission($updateData, $roleId, $moduleId)
    {
        $whereData = array(
            'role_id' => $roleId,
            'module_id' => $moduleId
        );

        $update = $this->db->update($this->table2, $updateData, $whereData);

        if ($update > 0) {
            $this->responseBody =  true;
        } else {
            $this->responseBody =  false;
        }

        return $this->responseBody;
    }
}