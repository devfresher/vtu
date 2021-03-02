<?php
require_once '../includes/config.php';
include_once '../model/User.php';

if (isset($_POST["login"]) AND !empty($_POST['login'])) {

    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    
    $user = new User($db);

    $loggedIn = $user->processLogin($username, $password);
    if (!$loggedIn) {
        $_SESSION["errorMessage"] = $clientLang['invalid_credentials'];
    }

    if (isset($_SESSION['errorMessage'])) {
        header("Location: ".$_POST['form_url']);
        exit();
    }

    header("Location: ".BASE_URL.'user/dashboard.php');
    exit();
}
