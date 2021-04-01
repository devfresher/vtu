<?php
require_once MODEL_DIR.'User.php';

$user = new User($db);

$anonymous_user_pages = array(
    BASE_PATH.'', 
    BASE_PATH.'index.php',
);
$user_authentication_pages = array(
    BASE_PATH.USER_ROOT.'login.php',
    BASE_PATH.USER_ROOT.'register.php',
    BASE_PATH.USER_ROOT.'changepassword.php',
    BASE_PATH.USER_ROOT.'forgotpassword.php',
);
$admin_authentication_pages = array(
    BASE_PATH.ADMIN_ROOT.'login.php',
    BASE_PATH.USER_ROOT.'cron.php',
);
$authenticated_pages = array(
    BASE_PATH.USER_ROOT.'home.php',
    BASE_PATH.USER_ROOT.'logout.php',
    BASE_PATH.USER_ROOT.'wallet.php',
    BASE_PATH.USER_ROOT.'share-money.php',
    BASE_PATH.USER_ROOT.'airtime-topup.php',
    BASE_PATH.USER_ROOT.'receipt.php',
    BASE_PATH.USER_ROOT.'my-profile.php',
    BASE_PATH.USER_ROOT.'change-password.php',
    BASE_PATH.USER_ROOT.'gsmdatabundle.php',
);
$admin_pages = array(
    BASE_PATH.ADMIN_ROOT.'dashboard.php',
    BASE_PATH.ADMIN_ROOT.'products.php',
    BASE_PATH.ADMIN_ROOT.'plan-management.php',
    BASE_PATH.ADMIN_ROOT.'plan.php',
    BASE_PATH.ADMIN_ROOT.'member-info.php',
);

if ($user->isLoggedIn()) {
    if ($user->currentUser->role->role_name == 'User') {
        if (in_array(SCRIPT_NAME, $admin_pages)) {
            header('Location: '.BASE_URL.USER_ROOT.'home');
            exit;
        }elseif (in_array(SCRIPT_NAME, $admin_authentication_pages)) {
            header('Location: '.BASE_URL.USER_ROOT.'home');
            exit;
        }elseif (in_array(SCRIPT_NAME, $user_authentication_pages)) {
            header('Location: '.BASE_URL.USER_ROOT.'home');
            exit;
        }
    }
    elseif ($user->currentUser->role->role_name == 'Admin') {
        if (in_array(SCRIPT_NAME, $admin_authentication_pages)) {
            header('Location: '.BASE_URL.ADMIN_ROOT.'dashboard');
            exit;
        }elseif (in_array(SCRIPT_NAME, $user_authentication_pages)) {
            header('Location: '.BASE_URL.USER_ROOT.'dashboard');
            exit;
        }
    }
}else {
    if(in_array(SCRIPT_NAME, $authenticated_pages) || in_array(SCRIPT_NAME, $admin_pages)){
        header('Location: '.BASE_URL.USER_ROOT.'login');
        exit;
    }
}