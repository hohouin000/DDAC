<?php
//$mysqli = new mysqli("localhost", "root", "", "ddac");
$mysqli = new mysqli("ddac.co6fyvysy1hr.us-east-1.rds.amazonaws.com","admin","12345678","ddac");


if ($mysqli->connect_errno) {
    header("location: db_error.php");
    exit(1);
}

define('SITE_ROOT', realpath(dirname(__FILE__)));
// define('ADD_URL','http://localhost/DDAC-master1/DDAC/func-add-order.php');
// define('FAILED_URL','http://localhost/DDAC-master1/DDAC/order-failed.php');
define('ADD_URL','http://100.26.143.210/func-add-order.php');
define('FAILED_URL','http://100.26.143.210/order-failed.php');
date_default_timezone_set('Asia/Kuala_Lumpur');
