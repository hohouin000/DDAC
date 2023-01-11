<?php
include("../SNS_conn.php");
require('../vendor/autoload.php');
    use Pkerrigan\Xray\Trace;
    use Pkerrigan\Xray\Submission\DaemonSegmentSubmitter;
    use Pkerrigan\Xray\SqlSegment;
    use Pkerrigan\Xray\RemoteSegment;
use Pkerrigan\Xray\HttpSegment;

    Trace::getInstance()
    ->setTraceHeader($_SERVER['HTTP_X_AMZN_TRACE_ID'] ?? null)
    ->setName('customer-signup-sns/rds')
    ->setUrl($_SERVER['REQUEST_URI'])
    ->setMethod($_SERVER['REQUEST_METHOD'])
    ->begin(); 

session_start();
if (isset($_POST["content"], $_POST["title"]) && !empty($_POST["content"]) && !empty($_POST["title"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];

    try {
   Trace::getInstance()
    ->getCurrentSegment()
    ->addSubsegment(
        (new RemoteSegment())
            ->setName('SNSBroadcastmessage')
            ->begin()    
    );

        $result = $SnSclient->publish([
            'Subject' => $title,
            'Message' => $content,
            'TopicArn' => $topic,
        ]);
Trace::getInstance()
    ->getCurrentSegment()
    ->end();
    Trace::getInstance()
    ->end()
    ->setResponseCode(http_response_code())
    ->submit(new DaemonSegmentSubmitter()); 

        //var_dump($result);
        $_SESSION["server_status"] = 1;
        header("location: cstaff-broadcast.php");
        exit(0);
    } catch (AwsException $e) {
        $_SESSION["server_status"] = 0;
        // output error message if fails
        error_log($e->getMessage());
        header("location: cstaff-broadcast.php");
        exit(1);
    }
};
