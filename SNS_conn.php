<?php
require 'aws/aws-autoloader.php';
use Aws\Sns\SnsClient; 
use Aws\Exception\AwsException;

$SnSclient = new SnsClient([
	'region'  => 'us-east-1',
	'version' => 'latest',
	'credentials' => [
	    'key'    => "ASIAXOBIIX4W6QUXU4PH",
	    'secret' => "A8/aNz7eb5qrrOtMy9s9YH1XM3d/+bPXw3nrn6jR",
        'token'=>"FwoGZXIvYXdzENP//////////wEaDOqXNdMaZfMSZ/5xWiLJASar9rrJJ2tZ9WCKr5H10tKP1XZPYICHgvqo0f13tw1GKynngM5MdANuCVVMQ14si8M/dEr4QU82krI1hKZo08pmjCTwd176FXuyiFpW9P3JCmVPLolmbhTg6F6b5LmH8mY5HUSn7qz5R+oaNBQLKrcrpQyVAWAuTIg6+1dSbVuRbAUqM/9hFI9UzFyoWuyn+l52EwabvQKYHVVrKlUkIpvB+DmurCxW137y4B1sSL0IeOYame/7bbRSsDO0IBxfttJ0v9lhU+UECCiJ7KOdBjItoBahNi1zP/tiBI1S558CJneh9n0wF/7WWmmScjJx5vCS1l9GjTMyn5zy4ylB"
	]
]);

$protocol = 'email';
$endpoint = 'wtfoong81@gmail.com';
$topic = 'arn:aws:sns:us-east-1:511185567533:DDACAssignmentPastry';

try {
    $result = $SnSclient->subscribe([
        'Protocol' => $protocol,
        'Endpoint' => $endpoint,
        'ReturnSubscriptionArn' => true,
        'TopicArn' => $topic,
    ]);
	
    var_dump($result);
} catch (Aws\Exception\AwsException $e) {
    // output error message if fails
    error_log($e->getMessage());
} 

$message = 'Christmas is near and we have a bunch of chirstmas offers...XD';
$subject = 'pastry promotions';

try {
    $result = $SnSclient->publish([
		'Subject'=>$subject,
        'Message' => $message,
        'TopicArn' => $topic,
    ]);
    var_dump($result);
} catch (AwsException $e) {
    // output error message if fails
    error_log($e->getMessage());
} 


