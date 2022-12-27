<?php
require 'aws/aws-autoloader.php';
include("AWS_crededntials.php");
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



$message = 'Christmas is near and we have a bunch of chirstmas offers...XD';
$subject = 'pastry promotions';

try {
    $result = $SnSclient->publish([
		'Subject'=>$subject,
        'Message' => $message,
        'TopicArn' => $topic,
    ]);
    //var_dump($result);
} catch (AwsException $e) {
    // output error message if fails
    error_log($e->getMessage());
} 


