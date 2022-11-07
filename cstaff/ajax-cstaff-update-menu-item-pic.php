<?php session_start();
include("../conn_db.php");
require '../aws/aws-autoloader.php';
// File upload folder 
$uploadDir = '/img/menu/';

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

// Allowed file types 
$allowTypes = array('png');
if (!empty($_POST['mitem-id'])) {
    $mitem_id = $_POST['mitem-id'];
    $fileName = basename($_FILES["mitem-pic"]["name"]);
    $targetFilePath = $uploadDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    if (in_array($fileType, $allowTypes)) {

        $bucket = 'ddac-pastry-tp053060';
        
        //delete old image
        $query = "SELECT * FROM mitem WHERE mitem_id = '{$mitem_id}';";
        $result = $mysqli->query($query);
        $row = $result->fetch_array();
        //Set pic name into variable instead of using mysql query;
        $mitem_pic = $row['mitem_pic'];
        $key = basename($mitem_pic);
        try {
            $result = $s3Client->deleteObject(array(
                'Bucket' => $bucket,
                'Key'    => $key
            ));
        } catch (Aws\S3\Exception\S3Exception $e) {
            echo "There was an error deleting the file.\n";
            echo $e->getMessage();
        }



        //upload image to S3
       
        
        $temp_file_location = $_FILES['mitem-pic']['tmp_name'];
        $key = basename($fileName);
        try {
            $result = $s3Client->putObject([
            'Bucket' => $bucket,
            'Key'    => $key,
            'Body'   => $temp_file_location,
            'SourceFile' => $temp_file_location,
            'ACL'    => 'public-read', // make file 'public'
            'ContentType' => 'image/png',
            ]);
            
            $image_path = $result->get('ObjectURL');
            echo "Image uploaded successfully. Image path is: ".$image_path;
            $query = "UPDATE mitem SET mitem_pic = '{$image_path}' WHERE mitem_id = {$mitem_id};";
            $result = $mysqli->query($query);
            
            $response['server_status'] = 1;
        } catch (Aws\S3\Exception\S3Exception $e) {
            $response['server_status'] = 0;
            echo "There was an error uploading the file.\n";
            echo $e->getMessage();
        }
        




        // Upload file to the server 
        // $target_dir = '/img/menu/';
        // $temp = explode(".", $_FILES["mitem-pic"]["name"]);
        // $target_newfilename = "mitem_id_" . $mitem_id . "." . strtolower(end($temp));
        // $target_file = $target_dir . $target_newfilename;
        // if (move_uploaded_file($_FILES["mitem-pic"]["tmp_name"], SITE_ROOT . $target_file)) {
        //     $query = "UPDATE mitem SET mitem_pic = '{$target_newfilename}' WHERE mitem_id = {$mitem_id};";
        //     $result = $mysqli->query($query);
        //     $response['server_status'] = 1;
        //     echo json_encode($response);
        // }
    }
} else {
    $response['server_status'] = 0;
    echo json_encode($response);
}
