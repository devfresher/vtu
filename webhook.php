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

    $transaction->updateTxn($updateData, $event->dataid);
}

// Refund event
elseif ($event->status == "4") {

    $updateData  = array(
        'status' => 5,
        'message' => $event->msg,
    );

    $walletItem = $wallet->walletReadItemWithOrderId('wallet_out', $event->dataid);
    $date = date('Y-m-d H:i:s');
    
    $walletItemUser = $user->getUserById($walletItem->user_id);
    $walletItemUserBal = $wallet->getWalletBalance($walletItem->user_id);

    $reference = $utility->genUniqueRef('refund');
    $transactionItem = $transaction->getTxn($event->dataid);

    $walletRequestData = array(
        'user_id' => $walletItemUser->id,
        'old_balance' => $walletItemUserBal,
        'amount' => $walletItem->amount,
        'balance_after' => $walletItemUserBal + $walletItem->amount,
        'reference' => $walletItem->reference,
        'method' => '',
        'type' => 6,
        'status' => 3,
        'date' => $date,
    );

    $transactionData = array(
        'reference' => $reference,
        'product_plan_id' => $transactionItem->product_plan_id, 
        'order_id' => $event->dataid,
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
    $transaction->updateTxn($updateData, $event->dataid);
    $transaction->create($transactionData);
}

// Successful event
elseif ($event->status == "1") {

    $updateData  = array(
        'status' => 4,
        'message' => $event->msg,
    );

    $transaction->updateTxn($updateData, $event->dataid);
}

mail('fresher.dev01@gmail.com', 'Called', $data);
?>