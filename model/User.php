<?php
require_once '../model/Utility.php';
require_once '../model/Wallet.php';
require_once '../model/Plan.php';
require_once '../model/Role.php';

class User extends Utility {
    protected $db;
    public $userId;
    public $firstname;
    public $plan;
    public $role;
    public $walletBalance;
    protected $responseBody;

    function __construct($db) {
        $this->db = $db;

        
        if ($currentUser = $this->loggedInUser()) {
            $this->userId = $currentUser->id;
            $this->firstname = $currentUser->firstname;
            $this->firstLetter = $this->firstname[0];
            $this->lastname = $currentUser->lastname;
            $this->email = $currentUser->email;
            $this->phoneNumber = $currentUser->phone_number;
            $this->planId = $currentUser->plan;
            $this->roleId = $currentUser->role;

            $plan = new Plan($db);
            $this->plan = $this->arrayToObject($plan->getPlan($this->planId));
    
            $role = new Role($db);
            $this->role = $this->arrayToObject($role->getrole($this->roleId));
        }
    }

    function getUserById($userId) {
        $result = $this->db->getAllRecords("users", "*", "AND id = $userId");

        if (count($result) > 0) {
            $this->responseBody = $this->arrayToObject($result[0]);
        }else {
            $this->responseBody = false;
        }
        
        return $this->responseBody;
    }

    function getUser($key) {
        $result = $this->db->getAllRecords("users", "*", "AND email = '$key' OR phone_number = '$key'");

        if (count($result) > 0) {
            $this->responseBody = $this->arrayToObject($result[0]);
        }else {
            $this->responseBody = false;
        }
        
        return $this->responseBody;
    }

    function getUserByEmail($email) {
        $result = $this->db->getAllRecords("users", "*", "AND email = '$email'");
        
        if (count($result) > 0) {
            $this->responseBody = $this->arrayToObject($result[0]);
        }else {
            $this->responseBody = false;
        }
        
        return $this->responseBody;
    }

    function getUserByPhone($phone) {
        $result = $this->db->getAllRecords("users", "*", "AND phone_number = '$phone'");

        if (count($result) > 0) {
            $this->responseBody = $this->arrayToObject($result[0]);
        }else {
            $this->responseBody = false;
        }
        
        return $this->responseBody;
    }

    public function loggedInUser()
    {
       if (isset($_SESSION['userId']) AND !empty($_SESSION['userId'])) {
            $userId = $_SESSION['userId'];
            $result = $this->getUserById($userId);

            if ($result !== false){
                $this->responseBody = $result;
            }else {
                $this->responseBody = false;
            }
        }else {
            $this->responseBody = false;
        }
        return $this->responseBody;
    }
    
    public function processLogin($username, $password) {
        $result = $this->getUser($username);

        if ($result !== false){
            $_SESSION["userId"] = $result->id;
            $this->responseBody = true;
        }else {
            $this->responseBody = false;
        }

        return $this->responseBody;
    }

    public function processRegister($userData) {
        $result = $this->db->insert("users", $userData);

        if ($result) {
            $this->responseBody = true;
        }else {
            $this->responseBody = false;
        }

        return $this->responseBody;
    }

    public function isLoggedIn () {
        if ($this->loggedInUser() !== false) {
            $this->responseBody = true;
        }else {
            $this->responseBody = false;
        }

        return $this->responseBody;
    }

    public function hashPassword($password) {
        $hash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

        $this->responseBody = $hash;
        return $this->responseBody;
    }
}