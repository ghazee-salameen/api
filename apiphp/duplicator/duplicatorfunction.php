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


function updateduplicater($duplicaterInput,$duplicaterParams)
{

    global $conn;
    if(!isset($duplicaterParams['ID'])){
        return error422('duplicaterID Not Found');
    }elseif($duplicaterParams['ID']==null){
        return error422('Enetr duplicaterID');
    }

    $duplicaterID=mysqli_real_escape_string($conn,$duplicaterParams['ID']);
    
    $duplicaterType=mysqli_real_escape_string($conn, $duplicaterInput['duplicaterType']);
    $duplicaterModel=mysqli_real_escape_string($conn, $duplicaterInput['duplicaterModel']);
    $duplicaterDate=mysqli_real_escape_string($conn, $duplicaterInput['duplicaterDate']);
    $mCounter=mysqli_real_escape_string($conn, $duplicaterInput['mCounter']);
    $cCounter=mysqli_real_escape_string($conn, $duplicaterInput['cCounter']);


        $query="UPDATE duplicaterTbl SET duplicaterType = '$duplicaterType', duplicaterDate = '$duplicaterDate', duplicaterModel = '$duplicaterModel',mCounter = $mCounter,
        cCounter = $cCounter
         WHERE ID = $duplicaterID LIMIT 1";
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


function storeduplicater($schoolInput){
    global $conn;


    $schoolID=mysqli_real_escape_string($conn, $schoolInput['schoolID']);
    $duplicaterType=mysqli_real_escape_string($conn, $schoolInput['duplicaterType']);
    $duplicaterModel=mysqli_real_escape_string($conn, $schoolInput['duplicaterModel']);
    $duplicaterDate=mysqli_real_escape_string($conn, $schoolInput['duplicaterDate']);
    $mCounter=mysqli_real_escape_string($conn, $schoolInput['mCounter']);
    $cCounter=mysqli_real_escape_string($conn, $schoolInput['cCounter']);
    

    if(empty(trim($schoolID))){
    return error422('enter schoolID');

    }elseif (empty(trim($duplicaterType))) {
        return error422('enter duplicaterType');
        // code...
    }elseif (empty(trim($duplicaterDate))) {
        return error422('enter duplicaterDate');
        // code...
    }elseif (empty(trim($duplicaterModel))) {
        return error422('enter duplicaterModel');
        // code...
    }elseif (empty(trim($mCounter))) {
        return error422('enter mCounter');
        // code...
    }elseif (empty(trim($cCounter))) {
        return error422('enter cCounter');
        // code...
    }else
    {
        $query = "INSERT INTO duplicaterTbl (schoolID,duplicaterType, duplicaterModel,duplicaterDate,mCounter,cCounter) VALUES('$schoolID','$duplicaterType','$duplicaterModel','$duplicaterDate','$mCounter','$cCounter')";
        $result = mysqli_query($conn, $query);

        if($result)
        {
             $data = [
            'status' => 200,
            'message' =>  'duplicater Created Successfully',
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



function deleteduplicater($duplicaterParams){

    global $conn;

    if(!isset($duplicaterParams['ID'])){
        return error422('duplicater ID Not Found in Url');
    }elseif($duplicaterParams['ID']==null){
        return error422('Enetr duplicater ID');

    }

    $duplicaterID=mysqli_real_escape_string($conn,$duplicaterParams['ID']);
   // $duplicaterID=274;

    $query="DELETE FROM duplicaterTbl WHERE ID=$duplicaterID LIMIT 1";

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