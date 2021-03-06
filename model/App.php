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

        foreach ($result as $record) { 
            if ($record['option_key'] == "payment_settings") {
                $record['option_value'] = json_decode($record['option_value']);
            }
            $feedback[$record['option_key']] = $record['option_value'];
        }
        $this->responseBody = $this->arrayToObject($feedback);

        return $this->responseBody;
    }

    public function saveAppInfo($optionKey, $optionValue, $date)
    {
        $saveData = $this->db->update(
            $this->table, 
            array(
                'option_value' => $optionValue,
                'updated' => $date
            ), 
            array(
                'option_key' => $optionKey
            )
        );

        if ($saveData > 0) {
            $this->responseBody = true;
        }
        
        return $this->responseBody;
    }
}