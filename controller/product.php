<?php
require_once '../includes/config.php';
require_once '../model/Product.php';
require_once '../model/Transaction.php';
require_once '../model/Api.php';

$product = new Product($db);
$wallet = new Wallet($db);
$transaction = new Transaction($db);
$api = new Api($db);

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
    } elseif ($appInfo->min_airtime_vending > $amount) {
        $_SESSION["errorMessage"] = "You can not purchase airtime lesser than ".$appInfo->currency.$appInfo->min_airtime_vending;
    } elseif ($appInfo->max_airtime_vending < $amount) {
        $_SESSION["errorMessage"] = "You can not purchase airtime greater than ".$appInfo->currency.$appInfo->max_airtime_vending;
    } elseif(!is_numeric($phone_number) OR strlen($phone_number) != 11){
        $_SESSION["errorMessage"] = $clientLang['invalid_phone_number'];
    } elseif (!password_verify($pin, $user->currentUser->transaction_pin)) {
        $_SESSION["errorMessage"] = $clientLang['incorrect_pin'];
    }  else {
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
                    'order_id' => $verify->orderid,
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
                    'amount' => $amount,
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
                } else {
                    $db->rollBack();
                    $_SESSION["errorMessage"] = $verify->msg;
                }
            } elseif ($verify->status == "0"){
                $walletOutData = array(
                    'user_id' => $user->currentUser->id,
                    'old_balance' => $user->currentUser->walletBalance,
                    'amount' => $toPay,
                    'balance_after' => $user->currentUser->walletBalance - $toPay,
                    'reference' => $reference,
                    'order_id' => $verify->orderid,
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
                    'amount' => $amount,
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
                    $_SESSION["infoMessage"] = "Transaction sent. $phone_number has been recharged with ".strtoupper($network)." ".$appInfo->currency_text. $amount." airtime topup. Kindly check your account balance.";
                } else {
                    $db->rollBack();
                    $_SESSION["errorMessage"] = "Unexpected error occured";
                }
            } elseif ($verify->status == "2"){
                $walletOutData = array(
                    'user_id' => $user->currentUser->id,
                    'old_balance' => $user->currentUser->walletBalance,
                    'amount' => $toPay,
                    'balance_after' => $user->currentUser->walletBalance - $toPay,
                    'reference' => $reference,
                    'order_id' => $verify->orderid,
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
                    'amount' => $amount,
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
                } else {
                    $db->rollBack();
                    $_SESSION["errorMessage"] = "Unexpected error occured";
                }
            } else {
                if (isset($response->msg)) {
                    $transactionData = array(
                        'reference' => $reference,
                        'product_plan_id' => $productDetail->id, 
                        'order_id' => NULL,
                        'date' => $date,
                        'status' => 2,
                        'amount' => $amount,
                        'amount_charged' => 0,
                        'old_balance' => $user->currentUser->walletBalance,
                        'balance_after' => $user->currentUser->walletBalance,
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
                        'product_plan_id' => $productDetail->id, 
                        'order_id' => NULL,
                        'date' => $date,
                        'status' => 2,
                        'amount' => $amount,
                        'amount_charged' => 0,
                        'old_balance' => $user->currentUser->walletBalance,
                        'balance_after' => $user->currentUser->walletBalance,
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
            } 
        } else {
            if (isset($response->msg)) {
                $transactionData = array(
                    'reference' => $reference,
                    'product_plan_id' => $productDetail->id, 
                    'order_id' => NULL,
                    'date' => $date,
                    'status' => 2,
                    'amount' => $amount,
                    'amount_charged' => 0,
                    'old_balance' => $user->currentUser->walletBalance,
                    'balance_after' => $user->currentUser->walletBalance,
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
                    'product_plan_id' => $productDetail->id, 
                    'order_id' => NULL,
                    'date' => $date,
                    'status' => 2,
                    'amount' => $amount,
                    'amount_charged' => 0,
                    'old_balance' => $user->currentUser->walletBalance,
                    'balance_after' => $user->currentUser->walletBalance,
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
    
        }
    }
    // print_r($response);
    // print_r($_SESSION);
    header("Location: ".$_POST['form_url']);
    exit();
}

if (isset($_POST['fetch_products'])) {
    $response = $api->sendGetRequest('products', $data);

    $productData = array();

    $i = 0;
    foreach ($response as $product) {
        $productItem = $utility->db->getAllRecords("products", "*", " AND name = '$product->product_name' AND category = '$product->category'");
        if (count($productItem) > 0) {
            continue;
        }
        else {
            $productData[$i]['name'] = $product->product_name;
            $productData[$i]['product_code'] = $product->product_id;
            $productData[$i]['category'] = $product->category;
            $productData[$i]['plan'] = $product->plan;
        }
        $i++;
    }

    if (isset($productData) && !empty($productData)) {
        $insert = $utility->db->multiInsert("products", $productData);

        echo json_encode($productData);
        exit();
    }

}
?>