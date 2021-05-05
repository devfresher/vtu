<?php
require_once MODEL_DIR.'Utility.php';
Class HttpRequest
{

    const POST = 'POST';
    const PUT = 'PUT';
    const GET = 'GET';
    const DELETE = 'DELETE';
    const PATCH = 'PATCH';

    private $body;
    private $options;
    private static $handle;
    private static $httpCode;
    private static $response;

    /**
     * send post request
     * @param url 
     * @param header
     * @param options
     * @param body
     * @return json object
     * 
     */

    public static function post(string $url, array $header, array $body = [], array $options = [])
    {
        if(!self::$handle)
            self::$handle = curl_init();
        
        $header[] = "Content-Type: application/json";
        $body = json_encode($body);

        curl_setopt(self::$handle, CURLOPT_URL, $url);
        curl_setopt(self::$handle, CURLOPT_HTTPHEADER, $header);
        curl_setopt_array(self::$handle, $options);
        curl_setopt(self::$handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(self::$handle, CURLOPT_CUSTOMREQUEST, self::POST);
        curl_setopt(self::$handle, CURLOPT_POSTFIELDS, $body);

        self::$response = curl_exec(self::$handle);
        self::$httpCode = curl_getinfo(self::$handle, CURLINFO_HTTP_CODE);

        curl_close(self::$handle);
        
        return self::$response;
    }

    /**
     * send get request
     * @param url 
     * @param header 
     * @param options
     */
    public static function get($url, $header, $body=[], $options=[])
    {
        if(!self::$handle || get_resource_type(self::$handle) === "Unknown")
            self::$handle = curl_init(); 
        
        $header[] = "Content-Type: application/json";

        curl_setopt(self::$handle, CURLOPT_URL, $url);
        curl_setopt(self::$handle, CURLOPT_HTTPHEADER, $header);
        curl_setopt_array(self::$handle, $options);
        curl_setopt(self::$handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(self::$handle, CURLOPT_CUSTOMREQUEST, self::GET);
        curl_setopt(self::$handle, CURLOPT_POSTFIELDS, $body);


        self::$response = curl_exec(self::$handle);
        self::$httpCode = curl_getinfo(self::$handle, CURLINFO_HTTP_CODE);

        curl_close(self::$handle);

        return self::$response;
    }

    public static function getResponse()
    {
        return self::$response;
    }

    public static function getHttpCode()
    {
        return self::$httpCode;
    }


    /**
     * send patch request
     */ 
    public static function patch()
    {
        /**
         * @todo 
         * implemets this method
         */
    }


    /**
     * send delete request
     */
    public static function delete()
    {
        /**
         * @todo 
         * implemets this method
         */
    }


    /**
     * send put request
     */
    public static function put()
    {
        /**
         * @todo 
         * implemets this method
         */
    }
}
?>