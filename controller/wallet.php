<?php
require_once '../includes/config.php';
require_once '../model/Wallet.php';
require_once '../model/User.php';

$wallet = new Wallet($db);

if (isset($_POST['fund_wallet'])) {
    extract($_POST);

    $required_fields = array('amount_requested', 'method');
    foreach ($required_fields as $field) {
        if (in_array($field, array_keys($_POST)) AND $_POST[$field] != '') {
            continue;
        }else {
            $_SESSION['errorMessage'] = $clientLang['required_fields'];
            header("Location: ".$_POST['form_url']);
            exit();
        }
    }

    if(!filter_var($amount_requested, FILTER_VALIDATE_FLOAT)){
        $_SESSION["errorMessage"] = $clientLang['invalid_amount'];
        header("Location: ".$_POST['form_url']);
        exit();
    }

    elseif ($appInfo->min_fund_request > $amount_requested) {
        $_SESSION["errorMessage"] = "You can not fund with less than ".$appInfo->currency.$appInfo->min_fund_request;
        header("Location: ".$_POST['form_url']);
        exit();
    }

    else {
        $requestedAmount = filter_var($_POST["amount_requested"], FILTER_SANITIZE_NUMBER_FLOAT);
        $method = filter_var($_POST["method"], FILTER_SANITIZE_STRING);

        $reference = $utility->genUniqueRef('fund_wallet');

        switch ($method) {
            case 'manual':
                if ($requestedAmount >= $appInfo->min_stampduty) {
                    if ($requestedAmount < $appInfo->bank_stampduty) {
                        $_SESSION["errorMessage"] = 'Requested amount is greater than '.$appInfo->currency.$appInfo->bank_stampduty.' bank stampduty';
                        header("Location: ".$_POST['form_url']);
                        exit();
                    } else{
                        $amount = $requestedAmount - $appInfo->bank_stampduty; 
                    }
                } else {
                    $amount = $requestedAmount; 
                }
                break;
            
            case 'auto_fund':
                if ($requestedAmount < $appInfo->auto_funding_charge) {
                    $_SESSION["errorMessage"] = 'Your Requested amount must be greater than '.$appInfo->currency.$appInfo->auto_funding_charge.' auto funding charge';
                    header("Location: ".$_POST['form_url']);
                    exit();
                } else {
                    $amount = $requestedAmount - $appInfo->auto_funding_charge; 
                }
                break;
            
            default:
                break;
        }

        $walletRequestData = array(
            'user_id' => $user->currentUser->id,
            'old_balance' => $user->currentUser->walletBalance,
            'amount' => $amount,
            'balance_after' => $user->currentUser->walletBalance,
            'reference' => $reference,
            'method' => $method,
            'type' => 1,
            'status' => 1,
            'date' => date('Y-m-d H:i:s'),
        );

        // print_r($walletRequestData);
        if($wallet->fundWalletRequest($walletRequestData)){
            if ($method == 'auto_fund') {
                $_SESSION["successMessage"] = 'Autofunding Wallet request sent';
            } elseif ($method == 'manual') {
                $_SESSION["successMessage"] = 'Manual wallet request sent';
            }
            header("Location: ".$_POST['form_url']);
            exit();
        } else {
            $_SESSION["errorMessage"] = $clientLang['unexpected_error'];
            header("Location: ".$_POST['form_url']);
            exit();
        }

    }
}

elseif (isset($_POST['share_money'])) {
    extract($_POST);

    $required_fields = array('amount', 'phone_number', 'password');
    foreach ($required_fields as $field) {
        if (in_array($field, array_keys($_POST)) AND $_POST[$field] != '') {
            continue;
        }else {
            $_SESSION['errorMessage'] = $clientLang['required_fields'];
            header("Location: ".$_POST['form_url']);
            exit();
        }
    }

    $currentUser = $user->getUserById($user->currentUser->id);

    if (!filter_var($amount, FILTER_VALIDATE_FLOAT)){
        $_SESSION["errorMessage"] = $clientLang['invalid_amount'];
    } elseif (!is_numeric($phone_number) OR strlen($phone_number) != 11){
        $_SESSION["errorMessage"] = $clientLang['invalid_phone_number'];
    } elseif ($phone_number == $user->currentUser->phone_number){
        $_SESSION["errorMessage"] = $clientLang['receipient_is_sender'];
    } elseif (!password_verify($password, $currentUser->transaction_pin)) {
        $_SESSION["errorMessage"] = $clientLang['incorrect_pin'];
    } elseif ($user->currentUser->suspend == 1) {
        $_SESSION["errorMessage"] = $clientLang['account_suspended'];
    } else {
        $amount = filter_var($_POST["amount"], FILTER_SANITIZE_NUMBER_FLOAT);
        $phone = filter_var($_POST["phone_number"], FILTER_SANITIZE_STRING);

        $reference = $utility->genUniqueRef('share_wallet');

        $receipient = $user->getUserByPhone($phone);
        $receipient->walletBalance = $wallet->getWalletBalance($receipient->id);
        
        $db->beginTransaction();
        $walletInData = array(
            'user_id' => $receipient->id,
            'old_balance' => $receipient->walletBalance,
            'amount' => $amount,
            'balance_after' => $receipient->walletBalance + $amount,
            'reference' => $reference,
            'type' => 2,
            'status' => 4,
            'date' => date('Y-m-d H:i:s'),
        );
        $fund = $wallet->fundWalletRequest($walletInData);

        $walletOutData = array(
            'user_id' => $user->currentUser->id,
            'old_balance' => $user->currentUser->walletBalance,
            'amount' => $amount,
            'balance_after' => $user->currentUser->walletBalance - $amount,
            'reference' => $reference,
            'type' => 5,
            'status' => 4,
            'date' => date('Y-m-d H:i:s'),
        );
        $spend = $wallet->spendFromWallet($walletOutData);

        if ($fund !== false AND $spend !== false){
            $db->commit();
            $_SESSION["successMessage"] = 'Money shared successfully';
        } else {
            $db->rollBack();
            $_SESSION["errorMessage"] = 'Money can not be shared now';
        }
    }

    header("Location: ".$_POST['form_url']);
    exit();

    // print_r($_SESSION);
}

elseif (isset($_POST['modify_wallet'])) {
    extract($_POST);
    
    $required_fields = array('amount', 'type', 'pin');
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

    }elseif (!password_verify($pin, $user->currentUser->transaction_pin)) {
        $_SESSION["errorMessage"] = $clientLang['incorrect_pin'];
    } else {
        $userDetail = $user->getUserById($user_id);

        $amount = filter_var($_POST["amount"], FILTER_SANITIZE_NUMBER_FLOAT);
        $pin = filter_var($_POST['network_type'], FILTER_SANITIZE_NUMBER_INT);
        $description = filter_var($_POST['description'], FILTER_SANITIZE_STRIPPED);

        if($type == 'deduct') {
            
            if ($amount > $userDetail->walletBalance) {
                $_SESSION["errorMessage"] = "User wallet balance lesser than ".$amount;
                header("Location: ".$_POST['form_url']);
                exit();
            }else {
                $reference = $utility->genUniqueRef('admin_deduct');

                $walletOutData = array(
                    'user_id' => $user_id,
                    'old_balance' => $userDetail->walletBalance,
                    'amount' => $amount,
                    'balance_after' => $userDetail->walletBalance - $amount,
                    'reference' => $reference,
                    'description' => $description,
                    'type' => 3,
                    'status' => 6,
                    'date' => date('Y-m-d H:i:s'),
                );
                $deduct = $wallet->spendFromWallet($walletOutData);

                if ($deduct !== false){
                    $_SESSION["successMessage"] = $appInfo->currency.$amount.' deducted from '.$userDetail->firstname.'\'s wallet';
                } else {
                    $_SESSION["errorMessage"] = $clientLang['unexpected_error'];
                }
            }
        }elseif ($type == 'fund') {
            $reference = $utility->genUniqueRef('fund_wallet');

            $walletRequestData = array(
                'user_id' => $user_id,
                'old_balance' => $userDetail->walletBalance,
                'amount' => $amount,
                'balance_after' => $userDetail->walletBalance,
                'reference' => $reference,
                'description' => $description,
                'method' => 'manual',
                'type' => 1,
                'status' => 1,
                'date' => date('Y-m-d H:i:s'),
            );
            // print_r($walletRequestData);
            $request = $wallet->fundWalletRequest($walletRequestData);
            $approve = $wallet->approveWalletRequest($reference, $user->currentUser->id);

            if ($request !== false AND $approve !== false){
                $_SESSION["successMessage"] = $appInfo->currency_text.$amount.' added to '.$userDetail->firstname.'\'s wallet';
            } else {
                $_SESSION["errorMessage"] = $clientLang['unexpected_error'];
            }
        }elseif ($type == 'refund') {
            $reference = $utility->genUniqueRef('refund_wallet');

            $walletRequestData = array(
                'user_id' => $user_id,
                'old_balance' => $userDetail->walletBalance,
                'amount' => $amount,
                'balance_after' => $userDetail->walletBalance,
                'reference' => $reference,
                'description' => $description,
                'method' => 'manual',
                'type' => 3,
                'status' => 1,
                'date' => date('Y-m-d H:i:s'),
            );
            // print_r($walletRequestData);
            $request = $wallet->fundWalletRequest($walletRequestData);
            $approve = $wallet->approveWalletRequest($reference, $user->currentUser->id);

            if ($request !== false AND $approve !== false){
                $_SESSION["successMessage"] = $appInfo->currency_text.$amount.' refunded to '.$userDetail->firstname.'\'s wallet';
            } else {
                $_SESSION["errorMessage"] = $clientLang['unexpected_error'];
            }
        }

    }

    header("Location: ".$_POST['form_url']);
    exit();
    
}