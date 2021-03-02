<?php
$anonymous_user_pages = array(
    BASE_URL.'', 
    BASE_URL.'index.php',
);
$authentication_pages = array(
    BASE_URL.'user/login.php',
    BASE_URL.'user/register.php',
    BASE_URL.'admin/login.php', 
    BASE_URL.'admin/register.php',
    BASE_URL.'user/changepassword.php',
    BASE_URL.'user/forgotpassword.php',
);
$authenticated_user_pages = array(
    BASE_URL.'home.php', 
    BASE_URL.'notification.php',
    BASE_URL.'user/profile.php',
    BASE_URL.'user/account-setting.php',
    BASE_URL.'user/editprofile.php', 
    BASE_URL.'askfaaiz/ask.php',
    BASE_URL.'askfaaiz/questions.php',
    BASE_URL.'user/logout.php'
);
$admin_pages = array(
    BASE_URL.'admin/', 
    BASE_URL.'admin/dashboard.php',
    BASE_URL.'admin/askfaaiz.php',
    BASE_URL.'admin/users.php',
    BASE_URL.'admin/banner.php'
);
if (isset($_SESSION['id']) AND !empty($_SESSION['id'])) {
    if ($_SESSION['user_type'] == 'reader') {
        if (in_array(SCRIPT_NAME, $authentication_pages)) {
            header('Location: '.BASE_URL.'home.php');
            exit;
        }
        elseif (in_array(SCRIPT_NAME, $admin_pages)) {
            header('Location: '.BASE_URL.'home.php');
            exit;
        }elseif (in_array(SCRIPT_NAME, $writer_pages)) {
            header('Location: '.BASE_URL.'home.php');
            exit;
        }
    }
    elseif ($_SESSION['user_type'] == 'writer') {
        if (in_array(SCRIPT_NAME, $authentication_pages)) {
            header('Location: '.BASE_URL.'writer/myworks.php');
            exit;
        }
        elseif (in_array(SCRIPT_NAME, $admin_pages)) {
            header('Location: '.BASE_URL.'writer/myworks.php');
            exit;
        }
    }
    elseif ($_SESSION['user_type'] == 'admin') {
        if (in_array(SCRIPT_NAME, $authentication_pages)) {
            header('Location: '.BASE_URL.'admin/dashboard.php');
            exit;
        }
    }
}else {
    if (in_array(SCRIPT_NAME, $admin_pages)) {
        header('Location: '.BASE_URL.'admin/');
        exit;
    }elseif (in_array(SCRIPT_NAME, $writer_pages) OR in_array(SCRIPT_NAME, $reader_pages) OR in_array(SCRIPT_NAME, $authenticated_user_pages)) {
        header('Location: '.BASE_URL.'user/login.php');
    }    
}