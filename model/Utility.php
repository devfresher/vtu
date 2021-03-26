<?php
class Utility extends Database {

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

        $is_unique = 0;
        switch ($type) {
            case 'transactions':
                $prefix = 'TXN_';
                $table = 'transactions';
                $field = 'reference';

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
                break;
            case 'airtime_purchase':
                $prefix = 'ATM_';
                $table = 'transactions';
                $field = 'reference';

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
                break;

                case 'refund':
                    $prefix = 'REF_';
                    $table = 'transactions';
                    $field = 'reference';
    
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
                    break;

            case 'fund_wallet':
                $prefix = 'FWA_';
                $table = 'wallet_in';
                $field = 'reference';

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
                break;
            case 'share_wallet':
                $prefix = 'SWA_';
                $table1 = 'wallet_in';
                $table2 = 'wallet_out';
                $field = 'reference';

                while ($is_unique === 0) { 
                    try { 
                        $randID = $this->randID(5); // 5 is the number of characters 
                        $ref = $prefix.$randID;
        
                        $count1 = $this->db->getQueryCount($table1, "*", "AND $field = '$ref'");
                        $count2 = $this->db->getQueryCount($table2, "*", "AND $field = '$ref'");
        
                        if ($count1+$count2 > 0) { 
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
                break;
                case 'admin_deduct':
                    $prefix = 'ADD_';
                    $table = 'wallet_out';
                    $field = 'reference';
    
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
                    break;
                
            
            default:
                # code...
                break;
        }


    } 


    public function niceDateFormat($date)
    {
        $timestamp = strtotime($date);
        $niceFormat = date('D j, M Y h:ia', $timestamp);

        return $niceFormat;
    }

    public function is_cli()
    {
        return php_sapi_name() === 'cli';
    }

    public function accessAdmin()
    {
        $admin_pages = array(
            BASE_PATH.ADMIN_ROOT.'dashboard.php',
            BASE_PATH.ADMIN_ROOT.'products.php',
            BASE_PATH.ADMIN_ROOT.'plan-management.php',
            BASE_PATH.ADMIN_ROOT.'plan.php',
            BASE_PATH.ADMIN_ROOT.'member-info.php',
        );

        if (in_array(SCRIPT_NAME, $admin_pages)) {
            return true;
        }
        return false;
    }
}