<?php

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

?>