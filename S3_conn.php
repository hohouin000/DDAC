<?php
require '../aws/aws-autoloader.php';

$s3Client = new Aws\S3\S3Client([
	'region'  => 'us-east-1',
	'version' => 'latest',
    'scheme' => 'http',
	'credentials' => [
	    'key'    => "ASIAXOBIIX4WXKPRNVPN",
	    'secret' => "RhO+jT+RsTggyfOzSLKb2u6lw4h9eR3HoR7QFjMp",
        'token'=>"FwoGZXIvYXdzEFIaDJNtXEyZmk4c4s+F1yLJAVjRpkmMNxKqx5DVKUBOM1ddxraff1Nm+uZLEzlvPoDVPeNjgFu8JIXOm+IYQvsIFUfX3PW4nIh93mAC3cgg6KZ3bWkc0abmwS0nT1OQsLSTWefmfom8mziAuDg7xXYsEYjXfNN6U/w0iNj+r858C/dYxLq0MeqsQ5nyhy2aWY6qzffGBMI9dO8L02lbDrCEqNqas6KpCj4I/4yiiH9WPG7nj+DGU7Xc37UazSdWw48umgM9oaoQYC7AK4ABP8BUlaRzC2JdEKwAMSi01aabBjItm/UAhnAAstmETOhd7jsKPvE0gbouEfeT8+VWTeVS+PeT6tSk+5Cj5EvbTkGI"
	]
]);

$bucket = 'ddac-pastry-tp053060';


?>