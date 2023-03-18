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


function updatePrinter($printerInput,$printerParams)
{

    global $conn;
    if(!isset($printerParams['ID'])){
        return error422('printerID Not Found');
    }elseif($printerParams['ID']==null){
        return error422('Enetr printerID');
    }

    $printerID=mysqli_real_escape_string($conn,$printerParams['ID']);
    
    $printerType=mysqli_real_escape_string($conn, $printerInput['printerType']);
    $printerModel=mysqli_real_escape_string($conn, $printerInput['printerModel']);
    $printerDate=mysqli_real_escape_string($conn, $printerInput['printerDate']);
    
    


        $query="UPDATE printerTbl SET printerType = '$printerType', printerModel = '$printerModel',printerDate='$printerDate'
         WHERE ID = $printerID LIMIT 1";
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


function storePrinter($schoolInput){
    global $conn;


    $schoolID=mysqli_real_escape_string($conn, $schoolInput['schoolID']);
    $printerType=mysqli_real_escape_string($conn, $schoolInput['printerType']);
    $printerModel=mysqli_real_escape_string($conn, $schoolInput['printerModel']);
     $printerDate=mysqli_real_escape_string($conn, $schoolInput['printerDate']);
   //printerDate
    

    if(empty(trim($schoolID))){
    return error422('enter schoolID');

    }elseif (empty(trim($printerType))) {
        return error422('enter printerType');
        // code...
    }elseif (empty(trim($printerModel))) {
        return error422('enter printerModel');
        // code...
    }elseif (empty(trim($printerDate))) {
        return error422('enter printerDate');
        // code...
    }
    else
    {
        $query = "INSERT INTO printerTbl (schoolID,printerType, printerModel, printerDate) VALUES('$schoolID','$printerType','$printerModel','$printerDate')";
        $result = mysqli_query($conn, $query);

        if($result)
        {
             $data = [
            'status' => 200,
            'message' =>  'printer Created Successfully',
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



function deletePrinter($printerParams){

    global $conn;

    if(!isset($printerParams['ID'])){
        return error422('duplicater ID Not Found in Url');
    }elseif($printerParams['ID']==null){
        return error422('Enetr printer ID');

    }

    $printerID=mysqli_real_escape_string($conn,$printerParams['ID']);
   // $duplicaterID=274;

    $query="DELETE FROM printerTbl WHERE ID=$printerID LIMIT 1";

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