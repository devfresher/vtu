<?php
require_once '../includes/config.php';
require_once '../model/Api.php';
require_once '../model/Plan.php';
require_once '../model/Product.php';

$plan = new Plan($db);
$product = new Product($db);
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

elseif (isset($_POST['update_plan_product'])) {
    $productPlanData = $_POST['data'];
    
    $plan->db->beginTransaction();

    try {
        
        foreach ($productPlanData as $productPlan) {
            $updateData = array(
                'selling_percentage' => $productPlan['selling_percentage'], 
                'extra_charge' => $productPlan['extra_charge'], 
            );
            $whereData = array(
                'product_code' => $productPlan['product_code'],
                'plan_id' => $productPlan['plan_id']
            );
            
            echo $update = $utility->db->update($product->table2, $updateData, $whereData);
        }

        $utility->db->commit();

    } catch (Exception $e) {
        $utility->db->rollBack();
        echo $e->getMessage();
    }
}

elseif (isset($_POST['delete_plan'])) {
    $planId = $_POST['plan_id'];
    
    $plan->db->beginTransaction();

    try {
        $plan->db->delete($plan->table, array('id' => $planId));
        $plan->db->delete($plan->table2, array('plan_id' => $planId));
        $utility->db->commit();

    } catch (Exception $e) {
        $utility->db->rollBack();
        echo $e->getMessage();
    }
}
?>