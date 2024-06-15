<?php
require __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;

// Replace these with your Twilio account SID and auth token
$accountSid = "AC7a6fecbab1dc8728ac428309439782a3";
$authToken = "68f360148baf4d874c01badbf7bd3801";

$twilioClient = new Client($accountSid, $authToken);