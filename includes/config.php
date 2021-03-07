<?php
error_reporting();
session_start();
ob_start();

ini_set("memory_limit", "99M");
ini_set('post_max_size', '20M');
ini_set('max_execution_time', 600);

define('SERVER', $_SERVER['SERVER_NAME']);
define ('PAGE', basename($_SERVER['PHP_SELF']));
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('SCHEME', $_SERVER['REQUEST_SCHEME']);
define('PORT', $_SERVER['SERVER_PORT']);
define('REQUEST_URI', $_SERVER['REQUEST_URI']);
define('SCRIPT_NAME',$_SERVER['SCRIPT_NAME']);

if (SERVER != 'localhost' AND SERVER != '127.0.0.1' ) {
    define('BASE_PATH', '/2021vtu/', true);
    define('DB_NAME', 'generals_2021vtu');
    define('DB_USER', 'generals_2021vtu_super');
    define('DB_PASSWORD', 'g~(dU-Qb$iBp');
    define('DB_HOST', 'localhost');
}else{
    define('BASE_PATH', '/2021vtu/', true);
    define('DB_NAME', '2021vtu');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_HOST', 'localhost');
}

define('BASE_URL', SCHEME.'://'.SERVER.BASE_PATH, true);
define('MODEL_DIR', ROOT.BASE_PATH.'model/');
define('CONTROLLER_DIR', ROOT.BASE_PATH.'controller/');
define('INCLUDES_DIR', ROOT.BASE_PATH.'includes/');
define('VENDOR_DIR', ROOT.BASE_PATH.'vendor/');

define('USER_ROOT', '');
define('ADMIN_ROOT', 'admin/');
define('UPLOADS_DIR', 'uploads/');
define('PROFILE_UPLOADS_DIR', 'uploads/profile/');
define('LOGO_UPLOADS_DIR', 'uploads/logo/');
define('COMPONENT_DIR', 'components/');


$page = explode('.', PAGE);
define('PAGE_NAME', $page['0']);

require_once('Database.php');

$dsn = "mysql:dbname=" . DB_NAME . ";host=" . DB_HOST . "";
$pdo = "";
try {
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
$db = new Database($pdo);

include_once MODEL_DIR.'App.php';
include_once MODEL_DIR.'Utility.php';

$utility = new Utility($db);
$app = new APP($db);
$appInfo = $app->getAppInfo();

include_once INCLUDES_DIR.'session_check.php';
include_once INCLUDES_DIR.'language.php';
include_once INCLUDES_DIR.'functions.php';
include_once INCLUDES_DIR.'smtp_config.php';