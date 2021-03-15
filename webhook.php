<?php
require_once 'includes/config.php';
require_once 'model/Product.php';
require_once 'model/Transaction.php';
require_once 'model/Api.php';

$data = file_get_contents("php://input");
$event = json_decode($data);

$transaction = new Transaction($db);
$wallet = new Wallet($db);
$user = new User($db);

// Awaiting provider response event
if ($event->status == "2") {

    $updateData  = array(
        'status' => 1,
        'message' => $event->msg,
    );

    $transaction->updateTxn($updateData, $event->orderid);
}

// Refund event
elseif ($event->status == "4") {

    $updateData  = array(
        'status' => 5,
        'message' => $event->msg,
    );

    $walletItem = $wallet->walletReadItemWithOrderId('wallet_out', $event->orderid);
    
    $walletItemUser = $user->getUserById($walletItem->user_id);
    $walletItemUserBal = $wallet->getWalletBalance($walletItem->user_id);

    $walletRequestData = array(
        'user_id' => $walletItem->user_id,
        'old_balance' => $walletItemUserBal,
        'amount' => $walletItem->amount,
        'balance_after' => $walletItemUserBal + $walletItem->amount,
        'reference' => $walletItem->reference,
        'method' => '',
        'type' => 6,
        'status' => 3,
        'date' => date('Y-m-d H:i:s'),
    );

    $wallet->fundWalletRequest($walletRequestData);
    $transaction->updateTxn($updateData, $event->orderid);
}

// Successful event
elseif ($event->status == "1") {

    $updateData  = array(
        'status' => 4,
        'message' => $event->msg,
    );

    $transaction->updateTxn($updateData, $event->orderid);
}

mail('fresher.dev01@gmail.com', 'Called', 'Webhook called');
?>