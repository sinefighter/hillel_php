<?php 

require_once 'Response.php';

$response_code = http_response_code();
$content_type = $_SERVER['CONTENT_TYPE'];

$response = new Response($content_type, $response_code);

$response->send();