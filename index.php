<?php
include 'vendor\autoload.php';
use Pkerrigan\Xray\Trace;

    Trace::getInstance()
      ->setTraceHeader($_SERVER['HTTP_X_AMZN_TRACE_ID'] ?? null)
      ->setName('app.example.com')
      ->setUrl($_SERVER['REQUEST_URI'])
      ->setMethod($_SERVER['REQUEST_METHOD'])
      ->begin(); 
  
  

  

  Trace::getInstance()
  ->end()
  ->setResponseCode(http_response_code())
  ->submit(new \Pkerrigan\Xray\Submission\DaemonSegmentSubmitter());


?>
