<?php
require_once '../includes/config.php';
require_once '../model/Product.php';
require_once '../model/Transaction.php';
require_once '../model/Api.php';


if (isset($_POST['get_network_code'])) {
    extract($_POST);

    $phone = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
    $result = $appInfo->network_codes;

    $fisrtFour = substr($phone, 0, 4);
    
    $result = json_decode($result, true);
    $networkName = '';
    foreach ($result as $name => $codes) {
        if (in_array($fisrtFour, $codes)) {
            $networkName = $name;
            break;
        }
    }
    if ($networkName == '') {
        echo  "Unknown network coverage";
    }else {
        echo "Mobile number's network is ".$networkName;
    }
    exit();

} 

elseif (isset($_POST['get_product'])) {
    $productCode = filter_var($_POST["product_code"], FILTER_SANITIZE_STRING);
    $planId = filter_var($_POST["plan_id"], FILTER_SANITIZE_NUMBER_FLOAT);
    
    $product = new Product($db);
    $result = $product->getProductWithCode($productCode, $planId);

    echo json_encode($result);
    exit();
}

elseif (isset($_POST['buy_airtime'])) {
    extract($_POST);

    $required_fields = array('amount', 'network_type', 'pin', 'phone_number', );
    foreach ($required_fields as $field) {
        if (in_array($field, array_keys($_POST)) AND $_POST[$field] != '') {
            continue;
        }else {
            $_SESSION['errorMessage'] = $clientLang['required_fields'];
                header("Location: ".$_POST['form_url']);
                exit();
        }
    }

    if(!filter_var($amount, FILTER_VALIDATE_INT)){
        $_SESSION["errorMessage"] = $clientLang['invalid_amount'];
        header("Location: ".$_POST['form_url']);
        exit();
    } elseif ($appInfo->min_airtime_vending > $amount) {
        $_SESSION["errorMessage"] = "You can not purchase airtime lesser than ".$appInfo->currency.$appInfo->min_airtime_vending;
        header("Location: ".$_POST['form_url']);
        exit();
    } elseif ($appInfo->max_airtime_vending < $amount) {
        $_SESSION["errorMessage"] = "You can not purchase airtime greater than ".$appInfo->currency.$appInfo->min_airtime_vending;
        header("Location: ".$_POST['form_url']);
        exit();
    } elseif(!is_numeric($phone_number) OR strlen($phone_number) != 11){
        $_SESSION["errorMessage"] = $clientLang['invalid_phone_number'];
        header("Location: ".$_POST['form_url']);
        exit();
    } elseif (!password_verify($pin, $user->currentUser->transaction_pin)) {
        $_SESSION["errorMessage"] = $clientLang['incorrect_pin'];
        header("Location: ".$_POST['form_url']);
        exit();
    }  else {
        
        $product = new Product($db);
        $wallet = new Wallet($db);
        $transaction = new Transaction($db);
        $api = new Api($db);

        $amount = filter_var($_POST["amount"], FILTER_SANITIZE_NUMBER_INT);
        $productCode = filter_var($_POST['network_type'], FILTER_SANITIZE_STRING);

        $productDetail = $product->getProductWithCode($productCode, $user->currentUser->plan->id);
        $percentageDiscount = $productDetail->percentage_discount;

        if ($percentageDiscount > 0) {
            $toPay = $amount - ($amount* ($percentageDiscount/100));
        } else {
            $toPay = $amount;
        }

        $data = array(
            'network' => $productCode,
            'amount' => $amount,
            'phone' => $phone_number 
        );

        $response = $api->sendGetRequest('airtime', $data);

        $reference = $utility->genUniqueRef('airtime_purchase');
        $date = date('Y-m-d H:i:s');

        if ($response->status == "1") {
            $verify = $api->verifyOrder($response->orderid);

            if ($verify->status == "1") {

                $walletOutData = array(
                    'user_id' => $user->currentUser->id,
                    'old_balance' => $user->currentUser->walletBalance,
                    'amount' => $toPay,
                    'balance_after' => $user->currentUser->walletBalance - $toPay,
                    'reference' => $reference,
                    'type' => 4,
                    'status' => 4,
                    'date' => $date,
                );

                $transactionData = array(
                    'reference' => $reference,
                    'product_plan_id' => $productDetail->id, 
                    'order_id' => $verify->orderid,
                    'date' => $date,
                    'status' => 4,
                    'amount_charged' => $toPay,
                    'old_balance' => $user->currentUser->walletBalance,
                    'balance_after' => $user->currentUser->walletBalance - $toPay,
                    'received_by' => $phone_number,
                    'message' => $verify->msg,
                    'user_id' => $user->currentUser->id,
                );  
                
                $db->beginTransaction();
                $spend = $wallet->spendFromWallet($walletOutData);
                $tran = $transaction->create($transactionData);   
    
                if ($spend !== false AND $tran !== false){
                    $db->commit();
                    $_SESSION["successMessage"] = $verify->msg;
                    header("Location: ".$_POST['form_url']);
                    exit();
                } else {
                    $db->rollBack();
                    $_SESSION["errorMessage"] = $verify->msg;
                    header("Location: ".$_POST['form_url']);
                    exit();
                }
            } elseif ($verify->status == "0"){
                $walletOutData = array(
                    'user_id' => $user->currentUser->id,
                    'old_balance' => $user->currentUser->walletBalance,
                    'amount' => $toPay,
                    'balance_after' => $user->currentUser->walletBalance - $toPay,
                    'reference' => $reference,
                    'type' => 4,
                    'status' => 4,
                    'date' => $date,
                );

                $transactionData = array(
                    'reference' => $reference,
                    'product_plan_id' => $productDetail->id, 
                    'order_id' => $response->orderid,
                    'date' => $date,
                    'status' => 1,
                    'amount_charged' => $toPay,
                    'old_balance' => $user->currentUser->walletBalance,
                    'balance_after' => $user->currentUser->walletBalance - $toPay,
                    'received_by' => $phone_number,
                    'message' => $response->msg,
                    'user_id' => $user->currentUser->id,
                );  
                
                $db->beginTransaction();
                $spend = $wallet->spendFromWallet($walletOutData);
                $tran = $transaction->create($transactionData);   
    
                if ($spend !== false AND $tran !== false){
                    $db->commit();
                    $_SESSION["infoMessage"] = "Airtime purchase transaction pending, will be completed soon.";
                    header("Location: ".$_POST['form_url']);
                    exit();
                } else {
                    $db->rollBack();
                    $_SESSION["errorMessage"] = "Unexpected error occured";
                    header("Location: ".$_POST['form_url']);
                    exit();
                }
            } elseif ($verify->status == "2"){
                $walletOutData = array(
                    'user_id' => $user->currentUser->id,
                    'old_balance' => $user->currentUser->walletBalance,
                    'amount' => $toPay,
                    'balance_after' => $user->currentUser->walletBalance - $toPay,
                    'reference' => $reference,
                    'type' => 4,
                    'status' => 4,
                    'date' => $date,
                );

                $transactionData = array(
                    'reference' => $reference,
                    'product_plan_id' => $productDetail->id, 
                    'order_id' => $response->orderid,
                    'date' => $date,
                    'status' => 1,
                    'amount_charged' => $toPay,
                    'old_balance' => $user->currentUser->walletBalance,
                    'balance_after' => $user->currentUser->walletBalance - $toPay,
                    'received_by' => $phone_number,
                    'message' => $response->msg,
                    'user_id' => $user->currentUser->id,
                );  
                
                $db->beginTransaction();
                $spend = $wallet->spendFromWallet($walletOutData);
                $tran = $transaction->create($transactionData);   
    
                if ($spend !== false AND $tran !== false){
                    $db->commit();
                    $_SESSION["infoMessage"] = "Airtime purchase transaction awaiting response from network provider, will be completed soon.";
                    header("Location: ".$_POST['form_url']);
                    exit();
                } else {
                    $db->rollBack();
                    $_SESSION["errorMessage"] = "Unexpected error occured";
                    header("Location: ".$_POST['form_url']);
                    exit();
                }
            } else {
                if (isset($response->msg)) {
                    $transactionData = array(
                        'reference' => $reference,
                        'product_plan_id' => '', 
                        'order_id' => $response->orderid,
                        'date' => $date,
                        'status' => 1,
                        'amount_charged' => $toPay,
                        'old_balance' => $user->currentUser->walletBalance,
                        'balance_after' => $user->currentUser->walletBalance - $toPay,
                        'received_by' => $phone_number,
                        'message' => $response->msg,
                        'user_id' => $user->currentUser->id,
                    );
                    $db->beginTransaction();
                    $tran = $transaction->create($transactionData);   
    
                    if ($tran !== false){
                        $db->commit();
                        $_SESSION["errorMessage"] = $response->msg;
                    } else {
                        $db->rollBack();
                        $_SESSION["errorMessage"] = "Unexpected error occured";
                    } 
                } else {
                    $transactionData = array(
                        'reference' => $reference,
                        'product_plan_id' => '', 
                        'order_id' => $response->orderid,
                        'date' => $date,
                        'status' => 1,
                        'amount_charged' => $toPay,
                        'old_balance' => $user->currentUser->walletBalance,
                        'balance_after' => $user->currentUser->walletBalance - $toPay,
                        'received_by' => $phone_number,
                        'message' => 'Airtime topup not completed',
                        'user_id' => $user->currentUser->id,
                    );  
                    $db->beginTransaction();
                    $tran = $transaction->create($transactionData);   
    
                    if ($tran !== false){
                        $db->commit();
                        $_SESSION["errorMessage"] = "Airtime topup not completed";
                    } else {
                        $db->rollBack();
                        $_SESSION["errorMessage"] = "Unexpected error occured";
                    }
                }
                header("Location: ".$_POST['form_url']);
                exit();
            } 
        } else {
            if (isset($response->msg)) {
                $transactionData = array(
                    'reference' => $reference,
                    'product_plan_id' => '', 
                    'order_id' => $response->orderid,
                    'date' => $date,
                    'status' => 1,
                    'amount_charged' => $toPay,
                    'old_balance' => $user->currentUser->walletBalance,
                    'balance_after' => $user->currentUser->walletBalance - $toPay,
                    'received_by' => $phone_number,
                    'message' => $response->msg,
                    'user_id' => $user->currentUser->id,
                );

                $db->beginTransaction();
                $tran = $transaction->create($transactionData);   

                if ($tran !== false){
                    $db->commit();
                    $_SESSION["errorMessage"] = $response->msg;
                } else {
                    $db->rollBack();
                    $_SESSION["errorMessage"] = "Unexpected error occured";
                } 
            } else {
                $transactionData = array(
                    'reference' => $reference,
                    'product_plan_id' => '', 
                    'order_id' => $response->orderid,
                    'date' => $date,
                    'status' => 1,
                    'amount_charged' => $toPay,
                    'old_balance' => $user->currentUser->walletBalance,
                    'balance_after' => $user->currentUser->walletBalance - $toPay,
                    'received_by' => $phone_number,
                    'message' => 'Airtime topup not completed',
                    'user_id' => $user->currentUser->id,
                );  
                $db->beginTransaction();
                $tran = $transaction->create($transactionData);   

                if ($tran !== false){
                    $db->commit();
                    $_SESSION["errorMessage"] = "Airtime topup not completed";
                } else {
                    $db->rollBack();
                    $_SESSION["errorMessage"] = "Unexpected error occured";
                }
            }
            header("Location: ".$_POST['form_url']);
            exit();
    
        }
    }
}
?>