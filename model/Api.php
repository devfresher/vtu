<?php
require_once MODEL_DIR.'Utility.php';
class Api Extends Utility
{
    public function __construct($db) {
        $this->db = $db;
        $this->apiurl = APIURL;
        $this->apiuser = APIUSER;
        $this->apipassword = APIPASS;


    }

    public function sendGetRequest($api_endpoint, $data)
    {
        $url = $this->apiurl.$api_endpoint;
        
        $data['username'] = $this->apiuser;
        $data['password'] = $this->apipassword;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        
        $response = curl_exec($ch);
        return json_decode($response);
    }

    public function verifyOrder($orderId)
    {
        $url = $this->apiurl.'verifyorder';
        $data = array('orderid' => $orderId);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        
        $response = curl_exec($ch);
        return json_decode($response);
    }
}
?>