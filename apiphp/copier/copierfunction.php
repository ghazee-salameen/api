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


function updateCopier($copierInput,$copierParams)
{

    global $conn;
    if(!isset($copierParams['ID'])){
        return error422('copierID Not Found');
    }elseif($copierParams['ID']==null){
        return error422('Enetr copierID');
    }

    $copierID=mysqli_real_escape_string($conn,$copierParams['ID']);
    
    $copierType=mysqli_real_escape_string($conn, $copierInput['copierType']);
   
    $copierCo=mysqli_real_escape_string($conn, $copierInput['copierCo']);
    $copierModel=mysqli_real_escape_string($conn, $copierInput['copierModel']);
    $copierMaintenance=mysqli_real_escape_string($conn, $copierInput['copierMaintenance']);
    $copierOwner=mysqli_real_escape_string($conn, $copierInput['copierOwner']);
    $counter=mysqli_real_escape_string($conn, $copierInput['counter']);


        $query="UPDATE copierTbl SET copierType = '$copierType', copierCo = '$copierCo', copierModel = '$copierModel',copierMaintenance = $copierMaintenance,copierOwner = $copierOwner,counter = $counter WHERE ID = $copierID LIMIT 1";
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


function storeCopier($schoolInput){
    global $conn;


    $schoolID=mysqli_real_escape_string($conn, $schoolInput['schoolID']);
    $copierType=mysqli_real_escape_string($conn, $schoolInput['copierType']);
    $copierCo=mysqli_real_escape_string($conn, $schoolInput['copierCo']);
    $copierModel=mysqli_real_escape_string($conn, $schoolInput['copierModel']);
    $copierMaintenance=mysqli_real_escape_string($conn, $schoolInput['copierMaintenance']);
    $copierOwner=mysqli_real_escape_string($conn, $schoolInput['copierOwner']);
    $counter=mysqli_real_escape_string($conn, $schoolInput['counter']);

    if(empty(trim($schoolID))){
    return error422('enter schoolID');

    }elseif (empty(trim($copierType))) {
        return error422('enter copierType');
        // code...
    }elseif (empty(trim($copierCo))) {
        return error422('enter copierCo');
        // code...
    }elseif (empty(trim($copierModel))) {
        return error422('enter copierModel');
        // code...
    }elseif (empty(trim($copierMaintenance))) {
        return error422('enter copierMaintenance');
        // code...
    }elseif (empty(trim($copierOwner))) {
        return error422('enter copierOwner');
        // code...
    }elseif (empty(trim($counter))) {
        return error422('enter counter '.$counter.'1');
        // code...
    }else
    {
        $query = "INSERT INTO copierTbl (schoolID,copierType,copierCo, copierModel,copierMaintenance,copierOwner,counter) VALUES('$schoolID','$copierType','$copierCo','$copierModel','$copierMaintenance','$copierOwner',$counter)";
        $result = mysqli_query($conn, $query);

        if($result)
        {
             $data = [
            'status' => 200,
            'message' =>  'Copier Created Successfully',
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



function deleteCopier($copierParams){

    global $conn;

    if(!isset($copierParams['ID'])){
        return error422('copier ID Not Found in Url');
    }elseif($copierParams['ID']==null){
        return error422('Enetr copier ID');

    }

    $copierID=mysqli_real_escape_string($conn,$copierParams['ID']);
   // $copierID=274;

    $query="DELETE FROM copierTbl WHERE ID=$copierID LIMIT 1";

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
                'message' => 'Copier Not Found'
                
            ];
            header("HTTP/1.0 404 Copier Not Found");
            return json_encode($data);

    }



}