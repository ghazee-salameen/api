<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: PUT');
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-With');

require '../inc/function.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod == "PUT") 
    {
    $inputData=json_decode(file_get_contents('php://input'),true);
    if(empty($inputData))
        {
            $updateSchool=updateSchool($_POST,$_GET);

         }
         else
        {
            $updateSchool =updateSchool($inputData,$_GET);
        }

        echo $updateSchool;
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
