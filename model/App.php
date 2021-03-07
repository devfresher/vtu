<?php
require_once MODEL_DIR.'Utility.php';
class App Extends Utility
{

    public function getAppInfo()
    {
        $result = $this->db->getAllRecords("site_options", "*");

        foreach ($result as $i) { 
            $feedback[$i['option_key']] = $i['option_value'];
        }
        $this->responseBody = $this->arrayToObject($feedback);

        return $this->responseBody;
    }
}