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


function updatefacilities($facilitiesInput,$facilitiesParams)
{

    global $conn;
    if(!isset($facilitiesParams['ID'])){
        return error422('facilitiesID Not Found');
    }elseif($facilitiesParams['ID']==null){
        return error422('Enetr facilitiesID');
    }

    $facilitiesID=mysqli_real_escape_string($conn,$facilitiesParams['ID']);
    
   
    $roomArea=mysqli_real_escape_string($conn, $facilitiesInput['roomArea']);
    $roomName=mysqli_real_escape_string($conn, $facilitiesInput['roomName']);
    
    


        $query="UPDATE facilitiesTbl SET roomArea = $roomArea, roomName = '$roomName'
         WHERE ID = $facilitiesID LIMIT 1";
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


function storefacilities($facilitiesInput){
    global $conn;


    $schoolID=mysqli_real_escape_string($conn, $facilitiesInput['schoolID']);
     $roomArea=mysqli_real_escape_string($conn, $facilitiesInput['roomArea']);
    $roomName=mysqli_real_escape_string($conn, $facilitiesInput['roomName']);
   //facilitiesDate
    

    if(empty(trim($schoolID))){
    return error422('enter schoolID');

    }elseif (empty(trim($roomArea))) {
        return error422('enter roomArea');
        // code...
    }elseif (empty(trim($roomName))) {
        return error422('enter roomName');
        // code...
    }
    else
    {
        $query = "INSERT INTO facilitiesTbl (schoolID,roomArea, roomName) VALUES('$schoolID',$roomArea,'$roomName')";
        $result = mysqli_query($conn, $query);

        if($result)
        {
             $data = [
            'status' => 200,
            'message' =>  'facilities Created Successfully',
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



function deletefacilities($facilitiesParams){

    global $conn;

    if(!isset($facilitiesParams['ID'])){
        return error422('facilities ID Not Found in Url');
    }elseif($facilitiesParams['ID']==null){
        return error422('Enetr facilities ID');

    }

    $facilitiesID=mysqli_real_escape_string($conn,$facilitiesParams['ID']);
   // $duplicaterID=274;

    $query="DELETE FROM facilitiesTbl WHERE ID=$facilitiesID LIMIT 1";

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