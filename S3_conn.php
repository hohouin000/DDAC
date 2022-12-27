<?php
require 'aws/aws-autoloader.php';
include("AWS_crededntials.php");

$s3Client = new Aws\S3\S3Client([
	'region'  => 'us-east-1',
	'version' => 'latest',
    'scheme' => 'http',
	'credentials' => $credentials
]);

$bucket = 'ddac-pastry-tp053060';

