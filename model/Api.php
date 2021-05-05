<?php
require_once MODEL_DIR.'Utility.php';
require_once MODEL_DIR.'Http.php';

use HttpRequest;

class Api Extends Utility
{
    private $apiurl;
    private $apiuser;
    private $apipassword;

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
        
        $response = HttpRequest::get($url, $data);

        return $response;
    }

    public function verifyOrder($orderId)
    {
        $url = $this->apiurl.'verifyorder';
        $data = array('orderid' => $orderId);
        
        $response = HttpRequest::get($url, $data);

        return $response;
    }
}
?>