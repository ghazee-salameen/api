<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: DELETE');
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-With');

require 'wirelessfunction.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod == "DELETE") {
   
    $deleteWireless = deleteWireless($_GET);
    echo $deleteWireless;
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . ' Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}
