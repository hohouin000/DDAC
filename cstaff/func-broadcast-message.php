<?php
include("../SNS_conn.php");
session_start();
if (isset($_POST["content"], $_POST["title"]) && !empty($_POST["content"]) && !empty($_POST["title"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];

    try {
        $result = $SnSclient->publish([
            'Subject' => $title,
            'Message' => $content,
            'TopicArn' => $topic,
        ]);
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
