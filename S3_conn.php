<?php
require '../aws/aws-autoloader.php';

$s3Client = new Aws\S3\S3Client([
	'region'  => 'us-east-1',
	'version' => 'latest',
    'scheme' => 'http',
	'credentials' => [
	    'key'    => "ASIAXOBIIX4WSZCOGJEQ",
	    'secret' => "FLjHWw9a6l4RLMXnQmDVQKYzl8HlGHVn0quccGID",
        'token'=>"FwoGZXIvYXdzELr//////////wEaDNhzd1CCqcMcDFEr8iLJAUlyJY3eltiiHNiRaPYVAaxjAhZ75FtOePgRCZDlqVomWJBNMcKYMMFbvHu32R8JNgXBiPXqFeqRecdNusUBUlmhYXNoBMS+sSRqauvQ4mnCoH1Prn5DGlOh5NUN0sbat7VlXMhyk5Oooi5W+y7na8y9qxfvjZfN2RgDJ0j6UA0K83+QLfzr43taACy7MMy3m9+AVCdSW0l9u74pPnz99SiqteCuiO+Avf9jnbOeUE8Ew2gu048DKpV+E1ZEaLtQkbHGEnsSjvvOjyj23PWbBjItoEnWl5jD/N9Ypwjr9iN3OXedQpC0ZXAzE1srlk1IlJV/0k7/FTmNa6GuVvhH"
	]
]);

$bucket = 'ddac-pastry-tp053060';

