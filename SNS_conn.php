<?php
require 'aws/aws-autoloader.php';
include("AWS_credentials.php");
use Aws\Sns\SnsClient; 
use Aws\Exception\AwsException;

$SnSclient = new SnsClient([
	'region'  => 'us-east-1',
	'version' => 'latest',
	'credentials' => $credentials
]);

$protocol = 'email';
//$endpoint = 'wtfoong81@gmail.com';
$topic = 'arn:aws:sns:us-east-1:511185567533:DDACAssignmentPastry';

