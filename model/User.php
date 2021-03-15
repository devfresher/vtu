<?php
require_once MODEL_DIR.'Utility.php';
require_once MODEL_DIR.'Wallet.php';
require_once MODEL_DIR.'Plan.php';
require_once MODEL_DIR.'Role.php';

class User extends Utility {
    protected $db;
    public $currentUser;
    protected $responseBody;

    function __construct($db) {
        $this->db = $db;
        $this->table = 'users';

        $plan = new Plan($db);
        $role = new Role($db);
        $wallet = new Wallet($db);
        
        if ($this->loggedInUser() !== false) {
            $currentUser = $this->loggedInUser();

            $this->currentUser = $currentUser;
            $this->currentUser->firstLetter = $this->currentUser->firstname[0].$this->currentUser->lastname[0];
            $this->currentUser->fullName = $this->currentUser->firstname.' '.$this->currentUser->lastname;
            $this->currentUser->walletBalance = $wallet->getWalletBalance($currentUser->id);
            $this->currentUser->role = $this->arrayToObject($role->getrole($currentUser->role));
            $this->currentUser->plan = $this->arrayToObject($plan->getPlan($currentUser->plan));

            unset($this->currentUser->role->permission);
        }
    }

    function getUserById($userId) {
        $result = $this->db->getAllRecords($this->table, "*", "AND id = '$userId'");

        if (count($result) > 0) {
            $this->responseBody = $this->arrayToObject($result[0]);
        }else {
            $this->responseBody = false;
        }
        
        return $this->responseBody;
    }

    function getUser($key) {
        $result = $this->db->getAllRecords($this->table, "*", "AND email = '$key' OR phone_number = '$key'");

        if (count($result) > 0) {
            $this->responseBody = $this->arrayToObject($result[0]);
        }else {
            $this->responseBody = false;
        }
        
        return $this->responseBody;
    }

    function getUserByEmail($email) {
        $result = $this->db->getAllRecords($this->table, "*", "AND email = '$email'");
        
        if (count($result) > 0) {
            $this->responseBody = $this->arrayToObject($result[0]);
        }else {
            $this->responseBody = false;
        }
        
        return $this->responseBody;
    }

    function getUserByPhone($phone) {
        $result = $this->db->getAllRecords($this->table, "*", "AND phone_number = '$phone'");

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

            if ($result !== false) {
                unset($result->password);
                unset($result->token);
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
        $result = $this->db->insert($this->table, $userData);

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