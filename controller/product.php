<?php
require_once '../includes/config.php';
require_once '../model/Wallet.php';
require_once '../model/User.php';

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

elseif (isset($_POST['buy_airtime'])) {
    extract($_POST);

    $required_fields = array('amount', 'network_type', 'transaction_pin');
    foreach ($required_fields as $field) {
        if (in_array($field, array_keys($_POST)) AND $_POST[$field] != '') {
            continue;
        }else {
            $_SESSION['errorWalletMessage'] = $clientLang['required_fields'];
            header("Location: ".$_POST['form_url']);
            exit();
        }
    }
}
?>