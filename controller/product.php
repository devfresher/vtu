<?php
require_once '../includes/config.php';
require_once '../model/Product.php';
require_once '../model/Transaction.php';
require_once '../model/Api.php';

include_once '../model/Beneficiary.php';
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

    if(!filter_var($amount, FILTER_VALIDATE_FLOAT)){
        $_SESSION["errorMessage"] = $clientLang['invalid_amount'];
    } elseif ($appInfo->min_airtime_vending > $amount) {
        $_SESSION["errorMessage"] = "You can not purchase airtime lesser than ".$appInfo->currency.$appInfo->min_airtime_vending;
    } elseif ($appInfo->max_airtime_vending < $amount) {
        $_SESSION["errorMessage"] = "You can not purchase airtime greater than ".$appInfo->currency.$appInfo->max_airtime_vending;
    } elseif(!is_numeric($phone_number) OR strlen($phone_number) != 11){
        $_SESSION["errorMessage"] = $clientLang['invalid_phone_number'];
    } elseif (!password_verify($pin, $user->currentUser->transaction_pin)) {
        $_SESSION["errorMessage"] = $clientLang['incorrect_pin'];
    } elseif ($user->currentUser->suspend == 1) {
        $_SESSION["errorMessage"] = $clientLang['account_suspended'];
    } else {
        $amount = filter_var($_POST["amount"], FILTER_SANITIZE_NUMBER_FLOAT);
        $productCode = filter_var($_POST['network_type'], FILTER_SANITIZE_STRING);

        $productDetail = $product->getProductWithCode($productCode, $user->currentUser->plan->id);
        $percentageDiscount = $productDetail->percentage_discount;

        if ($percentageDiscount > 0) {
            $toPay = $amount - ($amount * ($percentageDiscount/100));
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
                    'status' => 2,
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
                        'status' => 0,
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
                        'status' => 0,
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
                    'status' => 0,
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
                    'status' => 0,
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

        if ($add_beneficiary == 'on') {
            $beneficiary = new Beneficiary($db);

            $beneficiaryData = array('phone_number' => $phone_number, 'user_id' => $user->currentUser->id );
            $beneficiary->create($beneficiaryData);
        }
    }
    header("Location: ".$_POST['form_url']);
    exit();
}

elseif (isset($_POST['buy_electricity'])) {
    extract($_POST);

    $required_fields = array('amount', 'disco_type', 'pin', 'metre_no',);
    foreach ($required_fields as $field) {
        if (in_array($field, array_keys($_POST)) AND $_POST[$field] != '') {
            continue;
        }else {
            $_SESSION['errorMessage'] = $clientLang['required_fields'];
            header("Location: ".$_POST['form_url']);
            exit();
        }
    }

    if(!filter_var($amount, FILTER_VALIDATE_FLOAT)){
        $_SESSION["errorMessage"] = $clientLang['invalid_amount'];
    } elseif (!password_verify($pin, $user->currentUser->transaction_pin)) {
        $_SESSION["errorMessage"] = $clientLang['incorrect_pin'];
    } elseif ($user->currentUser->suspend == 1) {
        $_SESSION["errorMessage"] = $clientLang['account_suspended'];
    } else {
        $amount = filter_var($_POST["amount"], FILTER_SANITIZE_NUMBER_FLOAT);
        $productCode = filter_var($_POST['disco_type'], FILTER_SANITIZE_STRING);

        $productDetail = $product->getProductWithCode($productCode, $user->currentUser->plan->id);
        $percentageDiscount = $productDetail->percentage_discount;

        if ($percentageDiscount > 0) {
            $toPay = $amount - ($amount * ($percentageDiscount/100));
        } else {
            $toPay = $amount;
        }

        $data = array(
            'network' => $productCode,
            'amount' => $amount,
            'phone' => $phone_number 
        );

        $response = $api->sendGetRequest('electricity', $data);

        $reference = $utility->genUniqueRef('electricity_purchase');
        $date = date('Y-m-d H:i:s');

        
        if ($response->status == "1") {
            $verify = $api->verifyOrder($response->orderid);

            if ($verify->status == "1") {
                $walletOutData = array (
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
                    'received_by' => $metre_no,
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
                    if ($send_sms == 'on') {
                        $_SESSION["infoMessage"] = "Transaction sent. Token will be sent to ".$phone_number." shortly.";
                    } else {
                        $_SESSION["infoMessage"] = "Transaction sent.";
                    }
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
                    'status' => 2,
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
                    if ($send_sms == 'on') {
                        $_SESSION["infoMessage"] = "Transaction sent. Token will be sent to ".$phone_number." shortly.";
                    } else {
                        $_SESSION["infoMessage"] = "Transaction sent.";
                    }                
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
                        'status' => 0,
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
                        'status' => 0,
                        'amount' => $amount,
                        'amount_charged' => 0,
                        'old_balance' => $user->currentUser->walletBalance,
                        'balance_after' => $user->currentUser->walletBalance,
                        'received_by' => $phone_number,
                        'message' => 'Electricity purchase topup not completed',
                        'user_id' => $user->currentUser->id,
                    );  
                    $db->beginTransaction();
                    $tran = $transaction->create($transactionData);   
    
                    if ($tran !== false){
                        $db->commit();
                        $_SESSION["errorMessage"] = "Electricity purchase not completed";
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
                    'status' => 0,
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
                    'status' => 0,
                    'amount' => $amount,
                    'amount_charged' => 0,
                    'old_balance' => $user->currentUser->walletBalance,
                    'balance_after' => $user->currentUser->walletBalance,
                    'received_by' => $phone_number,
                    'message' => 'Electricity purchase not completed',
                    'user_id' => $user->currentUser->id,
                );  
                $db->beginTransaction();
                $tran = $transaction->create($transactionData);   

                if ($tran !== false){
                    $db->commit();
                    $_SESSION["errorMessage"] = "Electricity purchase not completed";
                } else {
                    $db->rollBack();
                    $_SESSION["errorMessage"] = "Unexpected error occured";
                }
            }
        }
    }
    header("Location: ".$_POST['form_url']);
    exit();
}

elseif (isset($_POST['fetch_products'])) {
    $url = 'http://vtutopup.com/telco/api';
    $data['method'] = 'all_products';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    
    $output = curl_exec($ch);
    $response = json_decode($output);

    $price_response = $api->sendGetRequest('products', $data);
    
    $productInsertData = array();

    $utility->db->beginTransaction();

    try {
        $utility->db->delete2("DELETE FROM $product->table1");

        $i = 0;
        foreach ($response as $product) {

            if(strpos($product->name, 'MTN') !== false){
                $productIcon = UPLOADS_DIR.'mtn1.png';
            } elseif(strpos($product->name, 'GLO') !== false){
                $productIcon = UPLOADS_DIR.'glo1.png';
            } elseif(strpos($product->name, 'Airtel') !== false){
                $productIcon = UPLOADS_DIR.'airtel1.png';
            } elseif(strpos($product->name, '9Mobile') !== false){
                $productIcon = UPLOADS_DIR.'9mobile.jpg';
            } elseif ($product->name == 'IBEDC Prepaid') {
                $productIcon = UPLOADS_DIR.'ibdec.jpg';
            } elseif ($product->name == 'Ikeja Prepaid') {
                $productIcon = UPLOADS_DIR.'ikedc.jpg';
            } elseif ($product->name == 'Eko Prepaid') {
                $productIcon = UPLOADS_DIR.'ekedc.jpg';
            } elseif ($product->name == 'Port Harcourt Prepaid') {
                $productIcon = UPLOADS_DIR.'phedc.jpg';
            } elseif ($product->name == 'Abuja Prepaid') {
                $productIcon = UPLOADS_DIR.'aedc.jpg';
            } elseif ($product->name == 'Enugu Prepaid') {
                $productIcon = UPLOADS_DIR.'eedc.png';
            } elseif ($product->name == 'Jos Prepaid') {
                $productIcon = UPLOADS_DIR.'jedc.jpg';
            } elseif ($product->name == 'Kaduna Prepaid') {
                $productIcon = UPLOADS_DIR.'kadedc.jpg';
            } elseif ($product->name == 'Kano Prepaid') {
                $productIcon = UPLOADS_DIR.'kedco.jpg';
            } elseif(strpos($product->name, 'Star Times') !== false){
                $productIcon = UPLOADS_DIR.'startimes.png';
            } elseif(strpos($product->name, 'DSTV') !== false){
                $productIcon = UPLOADS_DIR.'dstv.jpg';
            } elseif(strpos($product->name, 'GOtv') !== false){
                $productIcon = UPLOADS_DIR.'gotv.jpg';
            } elseif(strpos($product->name, 'Smile') !== false){
                $productIcon = UPLOADS_DIR.'smile.jpg';
            }

            $productInsertData[$i]['id'] = $i+1;
            $productInsertData[$i]['product_name'] = $product->name;
            $productInsertData[$i]['product_code'] = $product->product_code;
            $productInsertData[$i]['category'] = $product->category;
            $productInsertData[$i]['company_price'] = $product->company_price;
            $productInsertData[$i]['product_icon'] = $productIcon;
            $productInsertData[$i]['status'] = 1;
            $productInsertData[$i]['date'] = date('Y-m-d H:i:s');
            $productInsertData[$i]['cost_price'] = $price_response[$i]->vtutop_fee;

            $i++;
        }
    
        if (isset($productInsertData) && !empty($productInsertData)) {
            $insert = $utility->db->multiInsert("products", $productInsertData);
            $utility->db->commit();
        }

    } catch (Exception $e) {
        $utility->db->rollBack();
    }

}
?>