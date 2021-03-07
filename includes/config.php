<?php
error_reporting();
session_start();
ob_start();

ini_set("memory_limit", "99M");
ini_set('post_max_size', '20M');
ini_set('max_execution_time', 600);

define('UPLOADS_DIR', 'uploads/');
define('PROFILE_UPLOADS_DIR', 'uploads/profile/');
define('IMAGE_SMALL_DIR', 'uploads/small/');
define('IMAGE_SMALL_SIZE', 50);
define('IMAGE_MEDIUM_DIR', 'uploads/medium/');
define('IMAGE_MEDIUM_SIZE', 250);


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
define('USER_ROOT', 'app/');
define('ADMIN_ROOT', 'admin/');


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

include_once '../model/App.php';
include_once '../model/Utility.php';

$utility = new Utility($db);
$app = new APP($db);
$appInfo = $app->getAppInfo();

include_once 'session_check.php';
include_once 'language.php';
include_once 'functions.php';

/*
 * SMTP Debug.
 */
define('SMTP_DEBUG', false);
/*
 * Mail Encoding charset
 */
define('CHARSET', 'UTF-8');

/*
 * Mail Host
 */
// define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_HOST', 'mail.topupdrive.com');

/*
 * Mail Serve Port
 */
define('MAIL_PORT', 587);

/*
 * Use SMTP Authentication
 */
define('SMTP_AUTH', true);

/*
 * SMTP Authentication Type
 */
define('SMTP_AUTHTYPE', 'XOAUTH2');

/*
 * SMTP secure protocol
 */
define('SMTP_SECURE', 'tls');

/*
 * Oauth Authentication Email
 */
define('OAUTH_USEREMAIL', 'fresher.dev01@gmail.com');

/*
 * Oauth Authentication Client ID
 */
define('OAUTH_CLIENTID', '661433277252-qt86rg1k820s1gopsc6r6g79rsnqrq2h.apps.googleusercontent.com');

/*
 * Oauth Authentication Client Secret
 */
define('OAUTH_CLIENT_SECRET', 'wNwE69S34cpotreLhZnCpwGN');

/*
 * Oauth Authentication Refresh Token
 */
define('OAUTH_REFRESH_TOKEN', '1//03Ly9aO8rC9QVCgYIARAAGAMSNwF-L9IrzUX48M1kKjpYeeXiMK2b8peojRXn8AwHsHHE4n8NWx4hbNcNfpHLLmsNxA2Eq-KXR8E');

/*
 * Mail Authentication Username
 */
// define('MAIL_USERNAME', 'fresher.dev01@gmail.com');
define('MAIL_USERNAME', 'noreply@topupdrive.com');

/*
 * Mail From Email
 */
// define('MAIL_FROMEMAIL', 'fresher.dev01@gmail.com');
define('MAIL_FROMEMAIL', 'admin@topupdrive.com');


/*
 * Mail Reply To Email
 */
define('MAIL_REPLY_TO', 'noreply@topupdrive.com');

/*
 * Mail From Name
 */
define('MAIL_FROMNAME', 'Topup Drive');

/*
 * Mail Authentication Password
 */
define('MAIL_PASSWORD', 'D3vfr3$#3r');

/*
 * Use HTML Content
 */
define('HTML_BODY', true);

/*
 * Keep SMTP Connection Alive
 */
define('SMTP_ALIVE', true);

date_default_timezone_set("Africa/Lagos");

// session_destroy();
