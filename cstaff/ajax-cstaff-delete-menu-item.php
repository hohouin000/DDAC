<?php
session_start();
include('../conn_db.php');
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

$bucket = 'ddac-pastry-tp053060';

if (!empty(($_POST['mitem_id']))) {
    $mitem_id = $_POST['mitem_id'];
    $query = "SELECT * FROM mitem WHERE mitem_id = '{$mitem_id}';";
    $result = $mysqli->query($query);
    $row = $result->fetch_array();
    //Set pic name into variable instead of using mysql query;
    $mitem_pic = $row['mitem_pic'];
    $query = "DELETE FROM mitem WHERE mitem_id = '{$mitem_id}';";
    $result = $mysqli->query($query);
    $key = basename($mitem_pic);
    if ($result) {
        try {
            $result = $s3Client->deleteObject(array(
                'Bucket' => $bucket,
                'Key'    => $key
            ));
        } catch (Aws\S3\Exception\S3Exception $e) {
            echo "There was an error deleting the file.\n";
            echo $e->getMessage();
        }
        // $target_dir = '/img/menu/';
        // $target_file = $target_dir . $mitem_pic;
        // unlink(SITE_ROOT . $target_file);
        $response['server_status'] = 1;
    } else {
        $response['server_status'] = 0;
    }
}
echo json_encode($response);
