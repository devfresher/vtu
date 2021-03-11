<?php
require_once '../includes/config.php';
include_once '../model/User.php';

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

    $user = new User($db);

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
                    header("Location: ".BASE_URL.USER_ROOT.'dashboard.php');
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
        $user = new User($db);

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
                header("Location: ".BASE_URL.USER_ROOT.'login.php');
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