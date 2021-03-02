<?php
// namespace Model;

// use \Model\Database;

class User
{
    private $db;

    function __construct($db) {
        $this->db = $db;
    }

    function getUserById($userId) {
        $userResult = $this->db->getAllRecords("users", "*", "id = $userId");
        
        return $userResult;
    }

    function getUser($key) {
        $userResult = $this->db->getAllRecords("users", "*", "AND phone_number = '$key' OR email = '$key'");
        
        return $userResult;
    }
    
    public function processLogin($username, $password) {
        $userResult = $this->getUser($username);

        if(!empty($userResult) AND password_verify($password, $userResult[0]['password'])) {
            $_SESSION["userId"] = $userResult[0]["id"];
            return true;
        }
    }

    public function processRegister($userData) {
        $options = array('cost' => 12);
        $hashPassword = password_hash($userData['password'], PASSWORD_BCRYPT, $options);

        $userData['password'] = $hashPassword;
        $insertUserData = $this->db->insert("users", "$userData");

        if ($insertUserData) {
            return true;
        }
    }


}