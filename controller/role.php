<?php
require_once '../includes/config.php';
require_once '../model/Api.php';
require_once '../model/Role.php';
require_once '../model/Product.php';

$role = new Role($db);
$product = new Product($db);
$api = new Api($db);

if (isset($_POST['create_role'])) {
    extract($_POST);

    $required_fields = array('role_name', 'role_code');
    foreach ($required_fields as $field) {
        if (in_array($field, array_keys($_POST)) AND $_POST[$field] != '') {
            continue;
        }else {
            $_SESSION['errorMessage'] = $clientLang['required_fields'];
            header("Location: ".$_POST['form_url']);
            exit();
        }
    }

    $roleName = filter_var($role_name, FILTER_SANITIZE_STRING);
    $roleCode = filter_var($role_code, FILTER_SANITIZE_STRING);

    $roleData = array(
        'role_name' => $roleName,
        'role_code' => $roleCode,
        'created_by' => $user->currentUser->id,
        'created_date' => date("Y-m-d H:i:s"),
    );

    if($role->createRole($roleData)){
        $_SESSION["successMessage"] = $clientLang['role_created'];
    }
    else {
        $_SESSION["errorMessage"] = $clientLang['unexpected_error'];;
    }

    header("Location: ".$_POST['form_url']);
    exit();
} 

elseif (isset($_POST['update_role'])) {
    extract($_POST);
    $required_fields = array('role_name');
    foreach ($required_fields as $field) {
        if (in_array($field, array_keys($_POST)) AND $_POST[$field] != '') {
            continue;
        }else {
            $_SESSION['errorMessage'] = $clientLang['required_fields'];
            header("Location: ".$_POST['form_url']);
            exit();
        }
    }

    $roleName = filter_var($role_name, FILTER_SANITIZE_STRING);
    $roleId = filter_var($role_id, FILTER_SANITIZE_NUMBER_INT);

    $roleData = array(
        'role_name' => $roleName,
    );

    if($role->updaterole($roleData, $roleId)){
        $_SESSION["successMessage"] = $clientLang['role_updated'];
    }
    else {
        $_SESSION["errorMessage"] = $clientLang['unexpected_error'];
    }

    header("Location: ".$_POST['form_url']);
    exit();
}

elseif (isset($_POST['delete_role'])) {
    $roleId = $_POST['role_id'];
    
    $delete  = $role->deleteRole($roleId);

    if($delete) {
        $_SESSION['successMessage'] = $clientLang['role_deleted'];
    }
    else {
        $_SESSION['errorMessage'] = $clientLang['unexpected_error'];
    }
}

elseif (isset($_POST['set_permission'])) {
    $roleId = $_POST['role_id'];
    
    $delete  = $role->deleteRole($roleId);

    if($delete) {
        $_SESSION['successMessage'] = $clientLang['role_deleted'];
    }
    else {
        $_SESSION['errorMessage'] = $clientLang['unexpected_error'];
    }
}
?>