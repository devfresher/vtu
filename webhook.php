<?php
require_once 'includes/config.php';
require_once 'model/Transaction.php';
require_once 'model/Api.php';

$transaction = new Transaction($db);
$wallet = new Wallet($db);
$api = new  Api($db);

if (isset($_GET['requery'])) {
    extract($_GET);

    $event = $api->verifyOrder($id);
    $orderId = $event->orderid;
}else {
    if (!$appInfo->send_webhook_notification) {
        die();
    }
    $data = file_get_contents("php://input");
    $event = json_decode($data);
    $orderId = $event->dataId;
}

// Awaiting provider response event
if ($event->status == "2") {

    $updateData  = array(
        'status' => 1,
        'message' => $event->msg,
    );

    $transaction->updateTxn($updateData, $orderId);
    $_SESSION['infoMessage'] = $event->msg;
}

// Refund event
elseif ($event->status == "4") {

    $updateData  = array(
        'status' => 5,
        'message' => $event->msg,
    );

    $walletItem = $wallet->walletReadItemWithOrderId('wallet_out', $orderId);
    $date = date('Y-m-d H:i:s');

    
    $walletItemUser = $user->getUserById($walletItem->user_id);
    $walletItemUserBal = $wallet->getWalletBalance($walletItem->user_id);

    $reference = $utility->genUniqueRef('refund');
    $transactionItem = $transaction->getTxn($orderId);

    $walletRequestData = array(
        'user_id' => $walletItemUser->id,
        'old_balance' => $walletItemUserBal,
        'amount' => $walletItem->amount,
        'balance_after' => $walletItemUserBal + $walletItem->amount,
        'reference' => $walletItem->reference,
        'type' => 6,
        'status' => 3,
        'date' => $date,
    );

    $transactionData = array(
        'reference' => $reference,
        'product_plan_id' => $transactionItem->product_plan_id, 
        'order_id' => $orderId,
        'date' => $date,
        'status' => 5,
        'amount' => $transactionItem->amount,
        'amount_charged' => $transactionItem->amount_charged,
        'old_balance' => $walletItemUserBal,
        'balance_after' => $user->currentUser->walletBalance + $transactionItem->amount_charged,
        'received_by' => $transactionItem->received_by,
        'message' => 'Wallet refunded',
        'user_id' => $transactionItem->user_id,
    );

    $wallet->fundWalletRequest($walletRequestData);
    $transaction->updateTxn($updateData, $orderId);
    $transaction->create($transactionData);
    $_SESSION['success'] = $event->msg;

}

// Successful event
elseif ($event->status == "1") {

    $updateData  = array(
        'status' => 4,
        'message' => $event->msg,
    );

    $transaction->updateTxn($updateData, $orderId);
    $_SESSION['successMessage'] = $event->msg;
}

if (isset($_SERVER['HTTP_REFERER'])) {
    header('Location: '.$_SERVER['HTTP_REFERER']);
}

?>