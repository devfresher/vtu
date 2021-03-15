<?php
require_once MODEL_DIR.'Utility.php';
class App Extends Utility
{

    public function __construct($db) {
        $this->db = $db;
        $this->table = 'site_options';
    }

    public function getAppInfo()
    {
        $result = $this->db->getAllRecords($this->table, "*");

        foreach ($result as $i) { 
            $feedback[$i['option_key']] = $i['option_value'];
        }
        $this->responseBody = $this->arrayToObject($feedback);

        return $this->responseBody;
    }
}