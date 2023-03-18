<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: PUT');
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-With');

require 'duplicatorfunction.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod == "PUT") 
    {
    $inputData=json_decode(file_get_contents('php://input'),true);
    if(empty($inputData))
        {
            $updateDuplicater=updateDuplicater($_POST,$_GET);

         }
         else
        {
            $updateDuplicater =updateDuplicater($inputData,$_GET);
        }

        echo $updateDuplicater;
    }
     else
    {
    $data = [
        'status' => 405,
        'message' =>  'Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}