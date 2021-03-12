<?php
require_once '../includes/config.php';
require_once '../model/Product.php';
require_once '../model/Transaction.php';
require_once '../model/Api.php';

$data = file_get_contents("php://input");
$event = json_decode($data);

$transaction = new Transaction($db);

if ($event->status == "2") {

    $updateData  = array(
        'status' => 1,
        'message' => $event->msg,
    );

    $transaction->updateTxn($updateData, $event->orderid);
}

elseif ($event->status == "4") {

    $updateData  = array(
        'status' => 5,
        'message' => $event->msg,
    );

    $transaction->updateTxn($updateData, $event->orderid);
}

elseif ($event->status == "1") {

    $updateData  = array(
        'status' => 4,
        'message' => $event->msg,
    );

    $transaction->updateTxn($updateData, $event->orderid);
}

mail('fresher.dev01@gmail.com', 'Called', 'Webhook called');
?>