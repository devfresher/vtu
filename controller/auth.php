<?php
require_once '../includes/config.php';
include_once '../model/User.php';

$user = new User($db);

if (isset($_POST["login"])) {

    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    $required_fields = array('username', 'password');
    foreach ($required_fields as $field) {
        if (in_array($field, array_keys($_POST)) AND $_POST[$field] != '') {
            continue;
        }else {
            $_SESSION['errorLoginMessage'] = $clientLang['required_fields'];
            header("Location: ".$_POST['form_url']);
            exit();
        }
    }

    

    $userResult = $user->getUser($username);
    $hashPassword = $userResult->password;
    unset($userResult->password);

    if(!empty($userResult)) {
        if (password_verify($password, $hashPassword)) {
            if ($userResult->status == 0) {
                $_SESSION['errorLoginMessage'] = $clientLang['account_not_active'];
                header("Location: ".$_POST['form_url']);
                exit();
            }else {
                $loggedIn = $user->processLogin($username, $password);

                if (!$loggedIn) {
                    $_SESSION["errorLoginMessage"] = $clientLang['unexpected_error'];
                    header("Location: ".$_POST['form_url']);
                    exit();
                }else {
                    if (isset($_SERVER['HTTP_REFRRER'])) {
                        header("Location: ".$_SERVER['HTTP_REFRRER']);
                    }else {
                        header("Location: ".BASE_URL.USER_ROOT.'dashboard');
                    }
                    exit();
                } 
            }
        } else {
            $_SESSION['errorLoginMessage'] = $clientLang['invalid_password'];
            header("Location: ".$_POST['form_url']);
            exit();
        }
    } else {
        $_SESSION['errorLoginMessage'] = $clientLang['invalid_credentials'];
        header("Location: ".$_POST['form_url']);
        exit();
    }

}

elseif (isset($_POST["register"])) {
    extract($_POST);

    $required_fields = array('firstname', 'lastname', 'phoneNumber', 'password', 'cPassword');
    foreach ($required_fields as $field) {
        if (in_array($field, array_keys($_POST)) AND $_POST[$field] != '') {
            continue;
        }else {
            $_SESSION['errorRegisterMessage'] = $clientLang['required_fields'];
            header("Location: ".$_POST['form_url']);
            exit();
        }
    }

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $_SESSION["errorRegisterMessage"] = $clientLang['invalid_email_format'];
        header("Location: ".$_POST['form_url']);
        exit();
    }

    elseif(!is_numeric($phoneNumber) OR strlen($phoneNumber) != 11){
        $_SESSION["errorRegisterMessage"] = $clientLang['invalid_phone_number'];
        header("Location: ".$_POST['form_url']);
        exit();
    }

    elseif(strlen($password) < 6){
        $_SESSION['errorRegisterMessage'] = $clientLang['pass_len_6'];
        header("Location: ".$_POST['form_url']);
        exit();
    }

    elseif($password != $cPassword){
        $_SESSION['errorRegisterMessage'] = $clientLang['password_not_match'];
        header("Location: ".$_POST['form_url']);
        exit();
    }

    elseif($agree != 'on'){
        $_SESSION['errorRegisterMessage'] = $clientLang['accept_terms'];
        header("Location: ".$_POST['form_url']);
        exit();
    }

    else {
        $firstname = filter_var($_POST["firstname"], FILTER_SANITIZE_STRING);
        $lastname = filter_var($_POST["lastname"], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $phone = filter_var($_POST["phoneNumber"], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $cPassword = filter_var($_POST['cPassword'], FILTER_SANITIZE_STRING);

        $userPhoneResult = $user->getUserByPhone($phone);
        $userEmailResult = $user->getUserByEmail($email);

        if ($userPhoneResult !== false) {
            $_SESSION["errorRegisterMessage"] = $clientLang['phone_exist'];
            header("Location: ".$_POST['form_url']);
            exit();
        } elseif ($userEmailResult !== false) {
            $_SESSION["errorRegisterMessage"] = $clientLang['email_exist'];
            header("Location: ".$_POST['form_url']);
            exit();
        }else {
            $hashPassword = $user->hashPassword($password);
        
            $token = md5(uniqid('lcw-'.mt_rand(),true));
            $date_joined = date('Y-m-d H:i:s');
        
            $userData = array(
                'email'=>$email,
                'lastname'=>$lastname,
                'firstname'=>$firstname,
                'phone_number'=>$phone,
                'password'=>$hashPassword,
                'date_joined'=>$date_joined,
                'status'=>1,
                'token'=>$token
            );            
            $isRegitered = $user->processRegister($userData);
    
            if ($isRegitered) {
                header("Location: ".BASE_URL.USER_ROOT.'login');
                exit();
            }
        }

    }
}

elseif (isset($_POST['verify_user']) AND isset($_POST['user_id'])) {
    extract($_POST);
        
    $userId = filter_var($_POST["user_id"], FILTER_SANITIZE_STRING);
    $result = $user->getUser($userId);

    echo json_encode($result);
    exit();
}

elseif (isset($_POST["update_user"])) {
    extract($_POST);

    $required_fields = array('plan', 'role');
    foreach ($required_fields as $field) {
        if (in_array($field, array_keys($_POST)) AND $_POST[$field] != '') {
            continue;
        }else {
            $_SESSION['errorLoginMessage'] = $clientLang['required_fields'];
            header("Location: ".$_POST['form_url']);
            exit();
        }
    }

    $userDetail = $user->getUserById($user_id);

    if ($userDetail == false) {
        $_SESSION['errorMessage'] = $clientLang['user_not_found'];
    } else {

        $roleId = filter_var($_POST["role"], FILTER_SANITIZE_NUMBER_INT);
        $planId = filter_var($_POST["plan"], FILTER_SANITIZE_NUMBER_INT);
    
        if ($_POST["sales_reward"] == '') {
            $salesTargetReward = null;
        }else {
            $salesTargetReward = filter_var($_POST["sales_reward"], FILTER_SANITIZE_NUMBER_INT);
        }
    
        if ($_POST["sales_amount"] == '') {
            $salesTargetAmount = null;
        }else {
            $salesTargetAmount = filter_var($_POST["sales_amount"], FILTER_SANITIZE_NUMBER_INT);
        }
    
        if ($_POST["sales_services"] == '') {
            $salesTargetServices = null;
        }else {
            $salesTargetServices = filter_var($_POST["sales_services"], FILTER_SANITIZE_STRING);
        }
    
        if ($_POST["daily_min_purchase"] == '') {
            $dailyMinPurchase = null;
        }else {
            $dailyMinPurchase = filter_var($_POST["daily_min_purchase"], FILTER_SANITIZE_NUMBER_INT);
        }
    
        if ($_POST["min_wallet_recharge"] == '') {
            $minWalletRecharge = null;
        }else {
            $minWalletRecharge = filter_var($_POST["min_wallet_recharge"], FILTER_SANITIZE_NUMBER_INT);
        }
    
        if ($_POST["sms_noti"] == 'on') {
            $smsNoti = 1;
        }else {
            $smsNoti = 0;
        }
    
        $salesTargetPeriod = filter_var($_POST["sales_period"], FILTER_SANITIZE_STRING);
    
        $userUpdateData = array(
            'plan_id' => $planId, 
            'role_id' => $roleId,
            'sales_reward' => $salesTargetReward,
            'sales_amount' => $salesTargetAmount,
            'sales_period' => $salesTargetPeriod,
            'sales_services' => $salesTargetServices,
            'daily_min_purchase' => $dailyMinPurchase,
            'min_wallet_recharge' => $minWalletRecharge,
            'sms_noti' => $smsNoti
        );
        print_r($userUpdateData);
        
        $update = $user->updateUser($userUpdateData, $user_id);
    
        if ($update) {
            $_SESSION['successMessage'] = "User info updated successfully";
        } else {
            $_SESSION['errorMessage'] = $clientLang['unexpected_error'];
        }
        
    }

    // print_r($_SESSION);
    header("Location: ".$_POST['form_url']);
    exit();
}

elseif (isset($_POST["suspend_user"])) {
    extract($_POST);

    $userDetail = $user->getUserById($user_id);

    if ($userDetail == false) {
        $_SESSION['errorMessage'] = $clientLang['user_not_found'];
    } else {
            
        $userUpdateData = array(
            'suspend' => 1, 
        );
        
        $update = $user->updateUser($userUpdateData, $user_id);
    
        if ($update) {
            $result = '{
                "status": 1
            }';

            $_SESSION['successMessage'] = 'User suspended from purchase';
        } else {
            $result = '{
                "status": 0
            }';

            $_SESSION['errorMessage'] = $clientLang['unexpected_error'];
        }

        echo json_encode($result);
        exit();
    }

    header("Location: ".$_POST['form_url']);
    exit();
}

elseif (isset($_POST["unsuspned_user"])) {
    extract($_POST);

    $userDetail = $user->getUserById($user_id);

    if ($userDetail == false) {
        $_SESSION['errorMessage'] = $clientLang['user_not_found'];
    } else {
            
        $userUpdateData = array(
            'suspend' => 0, 
        );
        
        $update = $user->updateUser($userUpdateData, $user_id);
    
        if ($update) {
            $result = '{
                "status": 1
            }';
            $_SESSION['successMessage'] = 'User activated for purchase';
        } else {
            $result = '{
                "status": 0
            }';
            $_SESSION['errorMessage'] = $clientLang['unexpected_error'];
        }

        echo json_encode($result);
        exit();
    }

    header("Location: ".$_POST['form_url']);
    exit();
}

elseif (isset($_POST["disable_user"])) {
    extract($_POST);

    $userDetail = $user->getUserById($user_id);

    if ($userDetail == false) {
        $_SESSION['errorMessage'] = $clientLang['user_not_found'];
    } else {
            
        $userUpdateData = array(
            'disable' => 1, 
        );
        
        $update = $user->updateUser($userUpdateData, $user_id);
    
        if ($update) {
            $result = '{
                "status": 1
            }';
            $_SESSION['successMessage'] = 'User disabled successfully';
        } else {
            $result = '{
                "status": 0
            }';
            $_SESSION['errorMessage'] = $clientLang['unexpected_error'];
        }

        echo json_encode($result);
        exit();
    }

    header("Location: ".$_POST['form_url']);
    exit();
}

elseif (isset($_POST["enable_user"])) {
    extract($_POST);

    $userDetail = $user->getUserById($user_id);

    if ($userDetail == false) {
        $_SESSION['errorMessage'] = $clientLang['user_not_found'];
    } else {
            
        $userUpdateData = array(
            'disable' => 0, 
        );
        
        $update = $user->updateUser($userUpdateData, $user_id);
    
        if ($update) {
            $result = '{
                "status": 1
            }';
            $_SESSION['successMessage'] = 'User enabled successfully';
        } else {
            $result = '{
                "status": 0
            }';
            $_SESSION['errorMessage'] = $clientLang['unexpected_error'];
        }

        echo json_encode($result);
        exit();
    }

    header("Location: ".$_POST['form_url']);
    exit();
}