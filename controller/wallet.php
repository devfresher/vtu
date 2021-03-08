<?php
require_once '../includes/config.php';
require_once '../model/Wallet.php';
require_once '../model/User.php';

// $user = new User($db);

if (isset($_POST['fund_wallet'])) {
    extract($_POST);

    $required_fields = array('amount_requested', 'method');
    foreach ($required_fields as $field) {
        if (in_array($field, array_keys($_POST)) AND $_POST[$field] != '') {
            continue;
        }else {
            $_SESSION['errorWalletMessage'] = $clientLang['required_fields'];
            header("Location: ".$_POST['form_url']);
            exit();
        }
    }

    if(!filter_var($amount_requested,FILTER_VALIDATE_INT)){
        $_SESSION["errorWalletMessage"] = $clientLang['invalid_amount'];
        header("Location: ".$_POST['form_url']);
        exit();
    }

    elseif ($appInfo->min_fund_request > $amount_requested) {
        $_SESSION["errorWalletMessage"] = "You can not fund with less than ".$appInfo->currency.$appInfo->min_fund_request;
        header("Location: ".$_POST['form_url']);
        exit();
    }

    else {
        $wallet = new Wallet($db);

        $requestedAmount = filter_var($_POST["amount_requested"], FILTER_SANITIZE_STRING);
        $method = filter_var($_POST["method"], FILTER_SANITIZE_STRING);

        $reference = $utility->genUniqueRef('wallet');

        switch ($method) {
            case 'manual':
                if ($requestedAmount >= $appInfo->min_stampduty) {
                    if ($requestedAmount < $appInfo->bank_stampduty) {
                        $_SESSION["errorWalletMessage"] = 'Requested amount is greater than '.$appInfo->currency.$appInfo->bank_stampduty.' bank stampduty';
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
                    $_SESSION["errorWalletMessage"] = 'Your Requested amount must be greater than '.$appInfo->currency.$appInfo->auto_funding_charge.' auto funding charge';
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
        // print_r($wallet->fundWalletRequest($walletRequestData));
        if($wallet->fundWalletRequest($walletRequestData)){
            if ($method == 'auto_fund') {
                $_SESSION["successWalletMessage"] = 'auto_fund_request_sent';
            } elseif ($method == 'manual') {
                $_SESSION["successWalletMessage"] = 'manual_request_sent';
            }
            header("Location: ".$_POST['form_url']);
            exit();
        } else {
            $_SESSION["errorWalletMessage"] = $clientLang['unexpected_error'];
            header("Location: ".$_POST['form_url']);
            exit();
        }

    }
}