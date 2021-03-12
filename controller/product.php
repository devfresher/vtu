<?php
require_once '../includes/config.php';
require_once '../model/Product.php';

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
    //exit();

} 

elseif (isset($_POST['get_product'])) {
    $productCode = filter_var($_POST["product_code"], FILTER_SANITIZE_STRING);
    $planId = filter_var($_POST["plan_id"], FILTER_SANITIZE_NUMBER_FLOAT);
    
    $product = new Product($db);
    $result = $product->getProductWithCode($productCode, $planId);

    echo json_encode($result);
    //exit();
}

elseif (isset($_POST['buy_airtime'])) {
    extract($_POST);

    print_r($_POST);
    
    $required_fields = array('amount', 'network_type', 'pin', 'phone_number', );
    foreach ($required_fields as $field) {
        if (in_array($field, array_keys($_POST)) AND $_POST[$field] != '') {
            continue;
        }else {
            $_SESSION['errorMessage'] = $clientLang['required_fields'];
            //header("Location: ".$_POST['form_url']);
            //exit();
        }
    }

    if(!filter_var($amount, FILTER_VALIDATE_INT)){
        $_SESSION["errorMessage"] = $clientLang['invalid_amount'];
        //header("Location: ".$_POST['form_url']);
        //exit();
    } elseif ($appInfo->min_airtime_vending > $amount) {
        $_SESSION["errorMessage"] = "You can not purchase airtime lesser than ".$appInfo->currency.$appInfo->min_airtime_vending;
        //header("Location: ".$_POST['form_url']);
        //exit();
    } elseif ($appInfo->max_airtime_vending < $amount) {
        $_SESSION["errorMessage"] = "You can not purchase airtime greater than ".$appInfo->currency.$appInfo->min_airtime_vending;
        //header("Location: ".$_POST['form_url']);
        //exit();
    } elseif(!is_numeric($phone_number) OR strlen($phone_number) != 11){
        $_SESSION["errorMessage"] = $clientLang['invalid_phone_number'];
        //header("Location: ".$_POST['form_url']);
        //exit();
    } elseif (!password_verify($pin, $user->currentUser->transaction_pin)) {
        $_SESSION["errorMessage"] = $clientLang['incorrect_pin'];
        //header("Location: ".$_POST['form_url']);
        //exit();
    }  else {
        
        $product = new Product($db);

        $amount = filter_var($_POST["amount"], FILTER_SANITIZE_NUMBER_INT);
        $productCode = filter_var($_POST['network_type'], FILTER_SANITIZE_STRING);

        $productDetail = $product->getProductWithCode($productCode, $user->currentUser->plan->id);
        $percentageDiscount = $productDetail->percentage_discount;

        if ($percentageDiscount > 0) {
            $toPay = $amount - ($amount* ($percentageDiscount/100));
        } else {
            $toPay = $amount;
        }

        $url = APIURL."airtime?username=".APIUSER."&pasword=".APIPASS."&network=$productCode&amount=$amount&phone=$phone_number";

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);

        $response = json_encode(curl_exec($handle));
        curl_close($handle);

        print_r($response);

        if ($response->status == 1 AND $response->$response == "Completed") {
            $url = APIURL.'verifyorder?orderid='.$response->orderid;

            $handle = curl_init();
            curl_setopt($handle, CURLOPT_URL, $url);

            $response = json_encode(curl_exec($handle));
            curl_close($handle);

            if ($response->status == 1 AND $response->response == "Completed") {
                $reference = $utility->genUniqueRef('airtime_purchase');
                $date = date('Y-m-d H:i:s');
    
                $walletOutData = array(
                    'user_id' => $user->currentUser->id,
                    'old_balance' => $user->currentUser->walletBalance,
                    'amount' => $topay,
                    'balance_after' => $user->currentUser->walletBalance - $toPay,
                    'reference' => $reference,
                    'type' => 4,
                    'status' => 6,
                    'date' => $date,
                );
                $transactionData = array(
                    'product_plan_id' => $productDetail->id, 
                    'order_id' => $response->orderid,
                    'date' => $date,
                    'status' => 4,
                    'amount_charged' => $toPay,
                    'old_balance' => $user->currentUser->walletBalance,
                    'balance_after' => $user->currentUser->walletBalance - $toPay,
                    'received_by' => $phone,
                    'message' => $response->msg,
                    'user_id' => $user->currentUser->id,
                );  
                
                $db->beginTransaction();
                $spend = $wallet->spendFromWallet($walletOutData);
                $tran = $transaction->create($transactionData);   
    
                if ($spend !== false AND $tran !== false){
                    $db->commit();
                    $_SESSION["successMessage"] = $response->msg;
                    //header("Location: ".$_POST['form_url']);
                    //exit();
                } else {
                    $db->rollBack();
                    $_SESSION["errorMessage"] = 'Airtime Purchase not completed';
                    //header("Location: ".$_POST['form_url']);
                    //exit();
                }
            }

        }


    }
}
?>