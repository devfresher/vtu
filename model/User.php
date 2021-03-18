<?php
require_once MODEL_DIR.'Utility.php';
require_once MODEL_DIR.'Wallet.php';
require_once MODEL_DIR.'Plan.php';
require_once MODEL_DIR.'Role.php';

class User extends Utility {
    public $currentUser;
    protected $responseBody;

    function __construct($db) {
        $this->db = $db;
        $this->table = 'users';
        
        if ($this->loggedInUser() !== false) {
            $currentUser = $this->loggedInUser();

            $this->currentUser = $currentUser;
        }
    }

    function getUserById($userId) {
        
        $plan = new Plan($this->db);
        $role = new Role($this->db);
        $wallet = new Wallet($this->db);

        $result = $this->db->getAllRecords($this->table, "*", "AND id = '$userId'");

        if (count($result) > 0) {
            $this->responseBody = $this->arrayToObject($result[0]);
            
            $this->responseBody->walletBalance = $wallet->getWalletBalance($this->responseBody->id);
            $this->responseBody->role = $role->getrole($this->responseBody->role_id);
            $this->responseBody->plan = $plan->getPlan($this->responseBody->plan_id);

            $this->responseBody->firstLetter = $this->responseBody->firstname[0].$this->responseBody->lastname[0];
            $this->responseBody->fullName = $this->responseBody->firstname.' '.$this->responseBody->lastname;
        }else {
            $this->responseBody = false;
        }
        
        return $this->responseBody;
    }

    function getUser($key) {
        $plan = new Plan($this->db);
        $role = new Role($this->db);
        $wallet = new Wallet($this->db);

        $result = $this->db->getAllRecords($this->table, "*", "AND email = '$key' OR phone_number = '$key'");

        if (count($result) > 0) {
            $this->responseBody = $this->arrayToObject($result[0]);
            
            $this->responseBody->walletBalance = $wallet->getWalletBalance($this->responseBody->id);
            $this->responseBody->role = $role->getrole($this->responseBody->role_id);
            $this->responseBody->plan = $plan->getPlan($this->responseBody->plan_id);

            $this->responseBody->firstLetter = $this->responseBody->firstname[0].$this->responseBody->lastname[0];
            $this->responseBody->fullName = $this->responseBody->firstname.' '.$this->responseBody->lastname;
        }else {
            $this->responseBody = false;
        }
        
        return $this->responseBody;
    }

    function getUserByEmail($email) {
        $plan = new Plan($this->db);
        $role = new Role($this->db);
        $wallet = new Wallet($this->db);

        $result = $this->db->getAllRecords($this->table, "*", "AND email = '$email'");
        
        if (count($result) > 0) {
            $this->responseBody = $this->arrayToObject($result[0]);
            
            $this->responseBody->walletBalance = $wallet->getWalletBalance($this->responseBody->id);
            $this->responseBody->role = $role->getrole($this->responseBody->role_id);
            $this->responseBody->plan = $plan->getPlan($this->responseBody->plan_id);

            $this->responseBody->firstLetter = $this->responseBody->firstname[0].$this->responseBody->lastname[0];
            $this->responseBody->fullName = $this->responseBody->firstname.' '.$this->responseBody->lastname;
        }else {
            $this->responseBody = false;
        }
        
        return $this->responseBody;
    }

    function getUserByPhone($phone) {
        $plan = new Plan($this->db);
        $role = new Role($this->db);
        $wallet = new Wallet($this->db);
        $result = $this->db->getAllRecords($this->table, "*", "AND phone_number = '$phone'");

        if (count($result) > 0) {
            $this->responseBody = $this->arrayToObject($result[0]);
            
            $this->responseBody->walletBalance = $wallet->getWalletBalance($this->responseBody->id);
            $this->responseBody->role = $role->getrole($this->responseBody->role_id);
            $this->responseBody->plan = $plan->getPlan($this->responseBody->plan_id);

            $this->responseBody->firstLetter = $this->responseBody->firstname[0].$this->responseBody->lastname[0];
            $this->responseBody->fullName = $this->responseBody->firstname.' '.$this->responseBody->lastname;
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

    public function isAdmin($userId)
    {
        $user = $this->getUserById($userId);

        if ($user !== false AND $user->role->name == 'admin') {
            $this->responseBody = true;
        }else {
            $this->responseBody = false;
        }

        return $this->responseBody;
    }

    public function countLoginAttempts()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $result = $this->db->getAllRecords("login_attempts", "ip_address", "AND  ip_address = '$ip'  AND time BETWEEN DATE_SUB( NOW() , INTERVAL 10 MINUTES ) AND NOW()");
        $row  = $result->fetch_assoc();
        $failed_login_attempt = $row['failed_login_attempt'];
    }
}