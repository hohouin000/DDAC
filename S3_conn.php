<?php
require 'aws/aws-autoloader.php';

$s3Client = new Aws\S3\S3Client([
	'region'  => 'us-east-1',
	'version' => 'latest',
    'scheme' => 'http',
	'credentials' => [
	    'key'    => "ASIAXOBIIX4W6QUXU4PH",
	    'secret' => "A8/aNz7eb5qrrOtMy9s9YH1XM3d/+bPXw3nrn6jR",
        'token'=>"FwoGZXIvYXdzENP//////////wEaDOqXNdMaZfMSZ/5xWiLJASar9rrJJ2tZ9WCKr5H10tKP1XZPYICHgvqo0f13tw1GKynngM5MdANuCVVMQ14si8M/dEr4QU82krI1hKZo08pmjCTwd176FXuyiFpW9P3JCmVPLolmbhTg6F6b5LmH8mY5HUSn7qz5R+oaNBQLKrcrpQyVAWAuTIg6+1dSbVuRbAUqM/9hFI9UzFyoWuyn+l52EwabvQKYHVVrKlUkIpvB+DmurCxW137y4B1sSL0IeOYame/7bbRSsDO0IBxfttJ0v9lhU+UECCiJ7KOdBjItoBahNi1zP/tiBI1S558CJneh9n0wF/7WWmmScjJx5vCS1l9GjTMyn5zy4ylB"
	]
]);

$bucket = 'ddac-pastry-tp053060';

