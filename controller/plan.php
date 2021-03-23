<?php
require_once '../includes/config.php';
require_once '../model/Api.php';
require_once '../model/Plan.php';

$plan = new Plan($db);
$api = new Api($db);

if (isset($_POST['create_plan'])) {
    extract($_POST);

    $required_fields = array('plan_name', 'migration_fee', 'plan_lock', 'plan_type');
    foreach ($required_fields as $field) {
        if (in_array($field, array_keys($_POST)) AND $_POST[$field] != '') {
            continue;
        }else {
            $_SESSION['errorMessage'] = $clientLang['required_fields'];
            header("Location: ".$_POST['form_url']);
            exit();
        }
    }

    $planName = filter_var($plan_name, FILTER_SANITIZE_STRING);
    $migrationFee = filter_var($migration_fee, FILTER_SANITIZE_NUMBER_INT);
    $planLock = filter_var($plan_lock, FILTER_SANITIZE_NUMBER_INT);
    $planType = filter_var($plan_type, FILTER_SANITIZE_STRING);

    $planData = array(
        'plan_name' => $planName,
        'migration_fee' => $migrationFee,
        'plan_lock' => $planLock,
        'plan_type' => $planType,
        'created_by' => $user->currentUser->id,
        'created_date' => date("Y-m-d H:i:s"),
        'status' => 1
    );

    if($plan->createPlan($planData)){
        $_SESSION["successMessage"] = $clientLang['plan_created'];
    }
    else {
        $_SESSION["errorMessage"] = $clientLang['unexpected_error'];;
    }

    header("Location: ".$_POST['form_url']);
    exit();
} 

elseif (isset($_POST['update_plan'])) {
    extract($_POST);
    $required_fields = array('migration_fee', 'plan_lock', 'plan_type');
    foreach ($required_fields as $field) {
        if (in_array($field, array_keys($_POST)) AND $_POST[$field] != '') {
            continue;
        }else {
            $_SESSION['errorMessage'] = $clientLang['required_fields'];
            header("Location: ".$_POST['form_url']);
            exit();
        }
    }

    $planName = filter_var($plan_name, FILTER_SANITIZE_STRING);
    $migrationFee = filter_var($migration_fee, FILTER_SANITIZE_NUMBER_INT);
    $planLock = filter_var($plan_lock, FILTER_SANITIZE_NUMBER_INT);
    $planType = filter_var($plan_type, FILTER_SANITIZE_STRING);

    $planData = array(
        'migration_fee' => $migrationFee,
        'plan_lock' => $planLock,
        'plan_type' => $planType,
    );

    if($plan->updatePlan($planData, $plan_id)){
        $_SESSION["successMessage"] = $clientLang['plan_updated'];
    }
    else {
        $_SESSION["errorMessage"] = $clientLang['unexpected_error'];;
    }

    header("Location: ".$_POST['form_url']);
    exit();
} 
?>