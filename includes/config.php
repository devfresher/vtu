<?php
error_reporting(E_ALL & ~E_WARNING);
ob_start();
session_start();

// ini settings
ini_set("memory_limit", "99M");
ini_set('post_max_size', '20M');
ini_set('max_execution_time', 600);

// Sever constants
define('SERVER', $_SERVER['SERVER_NAME']);
define ('PAGE', basename($_SERVER['PHP_SELF']));
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('SCHEME', $_SERVER['REQUEST_SCHEME']);
define('PORT', $_SERVER['SERVER_PORT']);
define('REQUEST_URI', $_SERVER['REQUEST_URI']);
define('SCRIPT_NAME',$_SERVER['SCRIPT_NAME']);

// SQL database parameters
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

// Application constants
define('BASE_URL', SCHEME.'://'.SERVER.BASE_PATH, true);
define('MODEL_DIR', ROOT.BASE_PATH.'model/');
define('CONTROLLER_DIR', ROOT.BASE_PATH.'controller/');
define('INCLUDES_DIR', ROOT.BASE_PATH.'includes/');
define('VENDOR_DIR', ROOT.BASE_PATH.'vendor/');

define('USER_ROOT', '');
define('ADMIN_ROOT', 'web/');
define('UPLOADS_DIR', 'uploads/');
define('PROFILE_UPLOADS_DIR', 'uploads/profile/');
define('LOGO_UPLOADS_DIR', 'uploads/logo/');
define('COMPONENT_DIR', 'components/');

// API constants
define('APIURL', 'https://vtutopupbox.com/b2bhub/api/');
define('APIUSER', '09036830349');
define('APIPASS', 'D3vfr3$#3r');

// Page name constant
$page = explode('.', PAGE);
define('PAGE_NAME', $page['0']);

// Requirements
require_once(VENDOR_DIR.'autoload.php');
require_once('Database.php');
require_once("mysql.session.php");
// require_once INCLUDES_DIR.'transactionConnect.php';

// Database Coonection
$dsn = "mysql:dbname=" . DB_NAME . ";host=" . DB_HOST . "";
$pdo = "";
try {
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
$db = new Database($pdo);

// Includes
include_once MODEL_DIR.'App.php';
include_once MODEL_DIR.'Utility.php';
include_once INCLUDES_DIR.'language.php';
include_once INCLUDES_DIR.'smtp_config.php';
include_once INCLUDES_DIR.'session_check.php';

// Utility Functions
$utility = new Utility($db);

// Application defaults
$app = new APP($db);
$appInfo = $app->getAppInfo();

