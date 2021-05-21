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
        if($app->saveAppInfo($optionKey, $optionValue, date('Y-m-d H:i:s')) != true){
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

    $walletRequestMsg = filter_var($_POST["wallet_request_msg"], FILTER_SANITIZE_STRING);
    $senderWalletShareMsg = filter_var($_POST['sender_wallet_share_msg'], FILTER_SANITIZE_STRING);
    $registerMsg = filter_var($_POST['reg_msg'], FILTER_SANITIZE_STRING);
    $receiverWalletShareMsg = filter_var($_POST['receiver_wallet_share_msg'], FILTER_SANITIZE_STRING);
    $orderRefundMsg = filter_var($_POST['order_refund_msg'], FILTER_SANITIZE_STRING);
    $lowWalletMsg = filter_var($_POST['low_wallet_msg'], FILTER_SANITIZE_STRING);
    $electricityMsg = filter_var($_POST['electricity_msg'], FILTER_SANITIZE_STRING);
    $deductionMsg = filter_var($_POST['deduction_msg'], FILTER_SANITIZE_STRING);
    $blockedRegMsg = filter_var($_POST['bl_reg_msg'], FILTER_SANITIZE_STRING);
    $approvalMsg = filter_var($_POST['approval_msg'], FILTER_SANITIZE_STRING);

    $data = array(
        'sms_sender_id' => $senderId,
        'sms_route' => $route,
    );

    $db->beginTransaction();
    $status = true;
    foreach ($data as $optionKey => $optionValue) {
        if($app->saveAppInfo($optionKey, $optionValue, date('Y-m-d H:i:s')) != true){
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