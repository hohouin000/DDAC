<?php
require '../aws/aws-autoloader.php';

$s3Client = new Aws\S3\S3Client([
	'region'  => 'us-east-1',
	'version' => 'latest',
    'scheme' => 'http',
	'credentials' => [
	    'key'    => "ASIAXOBIIX4WQ3SNDUXC",
	    'secret' => "LnG3Y87QKjFOkK2bVsUBPxd6Z9xxCWa8zhPzRPw2",
        'token'=>"FwoGZXIvYXdzEDsaDPDe5RWDN3jgOpcrCiLJAaFTXYr1x/cRzVxfopXchpZTL0L7uZmf4A2HWPFQZ2JLp0PNTVpTHqBcsFsWUS4VrqlkiNo4/Mb0KbJLlfgQAZxhjrea9a47ZpgoIvWhtQjk1vXKzVJMn/hfmKqB21CTvjGpbvqbG1k9SkO/LypYyW7g5PF5E2GSqFI6rZksWzVQZFzCTpjlu1V/caik1IXMQ5yDoJEWaNRfKYKcCTPDvJJhy61PqLM1zk48TPo9adApc1lBg7u44wJTw4y3RAff1mh5Wz2rS3qUryiPt6GbBjItWo+EJgsnkDyluD//EL86bzMV1EI/br3xbH86HDfA4RFnTqUfr7Mt7GuRcXRZ"
	]
]);


?>