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

    private function randID($length) { 
        $vowels = 'aeiou'; 
        $consonants = '0123456789bcdfghjklmnpqrstvwxyz'; 
        $idnumber = ''; 
        $alt = time() % 2; 
        for ($i = 0; $i < $length; $i++) { 
            if ($alt == 1) { 
                $idnumber.= $consonants[(rand() % strlen($consonants)) ]; 
                $alt = 0; 
            } else { 
                $idnumber.= $vowels[(rand() % strlen($vowels)) ]; 
                $alt = 1; 
            } 
        } 
         
        return $idnumber; 
    } 

    public function genUniqueRef($type = 'transactions') { 

        switch ($type) {
            case 'transactions':
                $prefix = 'TXN_';
                $table = 'transactions';
                $field = 'reference';
                break;

            case 'wallet':
                $prefix = 'FWA_';
                $table = 'wallet_in';
                $field = 'reference';
                break;
            
            default:
                # code...
                break;
        }

        $is_unique = 0;
        while ($is_unique === 0) { 
            try { 
                $randID = $this->randID(5); // 5 is the number of characters 
                $ref = $prefix.$randID;

                $count = $this->db->getQueryCount($table, "*", "AND $field = '$ref'");

                if ($count > 0) { 
                    $randID = $this->randID(5); // 5 is the number of characters 
                    $ref = $prefix.$randID;
                } else { 
                    $is_unique = 1; 
                } 
            } 
            catch(PDOException $e) { 
                echo "Error generating or checking unique ID: " . $e->getMessage(); 
                exit(); 
            } 
            return $ref; 
        } 
    } 


    public function niceDateFormat($date)
    {
        $timestamp = strtotime($date);
        $niceFormat = date('D j, M Y G:ia', $timestamp);

        return $niceFormat;
    }
}