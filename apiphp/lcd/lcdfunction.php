<?php


require '../inc/dbconn.php';

function error422($message){
    $data = [
                'status' => 422,
                'message' =>  $message
                
            ];
            header("HTTP/1.0 422 Unprocessable Entry");
            return json_encode($data);
            exit();

}


function updateLcd($lcdInput,$lcdParams)
{

    global $conn;
    if(!isset($lcdParams['ID'])){
        return error422('lcdID Not Found');
    }elseif($lcdParams['ID']==null){
        return error422('Enetr lcdID');
    }

    $lcdID=mysqli_real_escape_string($conn,$lcdParams['ID']);
    
    $lcdType=mysqli_real_escape_string($conn, $lcdInput['lcdType']);
    $lcdModel=mysqli_real_escape_string($conn, $lcdInput['lcdModel']);
    $lcdDate=mysqli_real_escape_string($conn, $lcdInput['lcdDate']);
    
    


        $query="UPDATE lcdTbl SET lcdType = '$lcdType', lcdModel = '$lcdModel',lcdDate='$lcdDate'
         WHERE ID = $lcdID LIMIT 1";
        $result=mysqli_query($conn,$query);

        if($result)
        {
             $data = [
            'status' => 200,
            'message' =>  'Update Successfully',
        ];
        header("HTTP/1.0 200 updated");
        return json_encode($data);

        }else
        {
              $data = [
            'status' => 500,
            'message' =>  'Internal server Error',
        ];
        header("HTTP/1.0 500 Internal server Error");
        return json_encode($data);

        }
  

}


function storeLcd($schoolInput){
    global $conn;


    $schoolID=mysqli_real_escape_string($conn, $schoolInput['schoolID']);
    $lcdType=mysqli_real_escape_string($conn, $schoolInput['lcdType']);
    $lcdModel=mysqli_real_escape_string($conn, $schoolInput['lcdModel']);
     $lcdDate=mysqli_real_escape_string($conn, $schoolInput['lcdDate']);
   //lcdDate
    

    if(empty(trim($schoolID))){
    return error422('enter schoolID');

    }elseif (empty(trim($lcdType))) {
        return error422('enter lcdType');
        // code...
    }elseif (empty(trim($lcdModel))) {
        return error422('enter lcdModel');
        // code...
    }elseif (empty(trim($lcdDate))) {
        return error422('enter lcdDate');
        // code...
    }
    else
    {
        $query = "INSERT INTO lcdTbl (schoolID,lcdType, lcdModel, lcdDate) VALUES('$schoolID','$lcdType','$lcdModel','$lcdDate')";
        $result = mysqli_query($conn, $query);

        if($result)
        {
             $data = [
            'status' => 200,
            'message' =>  'lcd Created Successfully',
        ];
        header("HTTP/1.0 200 Created");
        return json_encode($data);

        }else
        {
             $data = [
            'status' => 500,
            'message' =>  'Internal server Error',
        ];
        header("HTTP/1.0 500 Internal server Error");
        return json_encode($data);
        }

    }

}



function deleteLcd($lcdParams){

    global $conn;

    if(!isset($lcdParams['ID'])){
        return error422('Lcd ID Not Found in Url');
    }elseif($lcdParams['ID']==null){
        return error422('Enetr lcd ID');

    }

    $lcdID=mysqli_real_escape_string($conn,$lcdParams['ID']);
   // $duplicaterID=274;

    $query="DELETE FROM lcdTbl WHERE ID=$lcdID LIMIT 1";

    $result=mysqli_query($conn,$query);

    if($result){
        echo $result;
         $data = [
                'status' => 200,
                'message' => 'Deleted Successfully'
                
            ];
            header("HTTP/1.0 200 Deleted");
            return json_encode($data);


    }else{
        $data = [
                'status' => 404,
                'message' => 'duplicater Not Found'
                
            ];
            header("HTTP/1.0 404 duplicater Not Found");
            return json_encode($data);

    }



}