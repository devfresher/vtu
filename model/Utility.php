<?php

class Utility extends Database {

    protected $db;
    protected $responseBody;

    function __construct($db) {
        $this->db = $db;
        $this->responseBody	= array();
    }

    /**
     * convert ojects to array
     *
     * @param array $array
     * @return object
     */
    public function arrayToObject($array)
    {
        return (object) $array;

    }

    /**
     * convert arrays to object
     *
     * @param object $object
     * @return array
     */
    public function objectToArray($object)
    {
	    return (array) $object;

    }
}