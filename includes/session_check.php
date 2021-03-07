<?php
require_once '../model/User.php';

$user = new User($db);

$anonymous_user_pages = array(
    BASE_PATH.'', 
    BASE_PATH.'index.php',
);
$authentication_pages = array(
    BASE_PATH.USER_ROOT.'login.php',
    BASE_PATH.USER_ROOT.'register.php',
    BASE_PATH.ADMIN_ROOT.'login.php', 
    BASE_PATH.ADMIN_ROOT.'register.php',
    BASE_PATH.USER_ROOT.'changepassword.php',
    BASE_PATH.USER_ROOT.'forgotpassword.php',
);
$authenticated_pages = array(
    BASE_PATH.USER_ROOT.'dashboard.php',
    BASE_PATH.USER_ROOT.'wallet.php',
);

if ($user->isLoggedIn()) {
    if (in_array(SCRIPT_NAME, $authentication_pages)) {
        header('Location: '.BASE_URL.USER_ROOT.'dashboard.php');
        exit;
    }
}else {
    if(in_array(SCRIPT_NAME, $authenticated_pages)){
        header('Location: '.BASE_URL.USER_ROOT.'login.php');
        exit;
    }
}