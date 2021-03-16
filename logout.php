<?php
require_once './includes/config.php';
session_start();
ob_start();

session_destroy();
header('Location: '.BASE_URL.USER_ROOT.'login');