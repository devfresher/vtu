<?php
require_once '../includes/config.php';
require_once '../model/Product.php';
require_once 'Sms.php';
require_once '../model/Transaction.php';
require_once '../model/App.php';

$product = new Product($db);
$wallet = new Wallet($db);
$transaction = new Transaction($db);
$api = new App($db);

if (isset($_POST['save_settings'])) {
    extract($_POST);

    $required_fields = array('sender_id', 'sms_route');
    foreach ($required_fields as $field) {
        if (in_array($field, array_keys($_POST)) AND $_POST[$field] != '') {
            continue;
        }else {
            $_SESSION['errorMessage'] = $clientLang['required_fields'];
            header("Location: ".$_POST['form_url']);
            exit();
        }
    }

    $senderId = filter_var($_POST["sender_id"], FILTER_SANITIZE_STRING);
    $route = filter_var($_POST['sms_route'], FILTER_SANITIZE_STRING);

    $data = array(
        'sms_sender_id' => $senderId,
        'sms_route' => $route,
    );

    $db->beginTransaction();
    $status = true;
    foreach ($data as $optionKey => $optionValue) {
        if($app->saveAppInfo($optionKey, $optionValue) != true){
            $status = false;
        }
    }

    if ($status == true) {
        $db->commit();
    } else {
        $db->rollBack();
    }

    header("Location: ".$_POST['form_url']);
    exit();
}


elseif (isset($_POST['save_messages'])) {
    extract($_POST);

    $required_fields = array('sender_id', 'sms_route');
    foreach ($required_fields as $field) {
        if (in_array($field, array_keys($_POST)) AND $_POST[$field] != '') {
            continue;
        }else {
            $_SESSION['errorMessage'] = $clientLang['required_fields'];
            header("Location: ".$_POST['form_url']);
            exit();
        }
    }

    $senderId = filter_var($_POST["sender_id"], FILTER_SANITIZE_STRING);
    $route = filter_var($_POST['sms_route'], FILTER_SANITIZE_STRING);

    $data = array(
        'sms_sender_id' => $senderId,
        'sms_route' => $route,
    );

    $db->beginTransaction();
    $status = true;
    foreach ($data as $optionKey => $optionValue) {
        if($app->saveAppInfo($optionKey, $optionValue) != true){
            $status = false;
        }
    }

    if ($status == true) {
        $db->commit();
    } else {
        $db->rollBack();
    }

    header("Location: ".$_POST['form_url']);
    exit();
}

?>