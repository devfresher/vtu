<?php
// Config
$dbhost = 'localhost';
$dbname = 'Employee_db';
 
// Connect to test database
$m = new Mongo("mongodb://$dbhost");
 
$db = $m--->$dbname;
// select the collection
$collection = $db->movie;
?>