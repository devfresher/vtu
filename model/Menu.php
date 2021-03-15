<?php
require_once MODEL_DIR.'Utility.php';
class Menu Extends Utility
{
    public function __construct($db) {
        $this->db = $db;
        $this->table = 'menu';
    }

    public function getMenu($location='', $roleId='')
    {
        if ($location != '' AND $roleId != '') {
            $result = $this->db->getRecFrmQry2(
                "SELECT * FROM $this->table WHERE location = '$location' AND FIND_IN_SET($roleId, role)"
            );
        }elseif ($location != '') {
            $result = $this->db->getRecFrmQry2(
                "SELECT * FROM $this->table WHERE location = '$location'"
            );
        }elseif ($roleId != '') {
            $result = $this->db->getRecFrmQry2(
                "SELECT * FROM $this->table WHERE FIND_IN_SET($roleId, role)"
            );
        }else {
            $result = $this->db->getRecFrmQry2(
                "SELECT * FROM $this->table"
            );
        }
    }
}
?>