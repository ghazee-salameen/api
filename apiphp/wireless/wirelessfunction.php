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


function updateWireless($WirelessInput,$WirelessParams)
{

    global $conn;
    if(!isset($WirelessParams['ID'])){
        return error422('WirelessID Not Found');
    }elseif($WirelessParams['ID']==null){
        return error422('Enetr WirelessID');
    }

    $WirelessID=mysqli_real_escape_string($conn,$WirelessParams['ID']);
    
    $WirelessType=mysqli_real_escape_string($conn, $WirelessInput['WirelessType']);
    $WirelessModel=mysqli_real_escape_string($conn, $WirelessInput['WirelessModel']);
    $WirelessDate=mysqli_real_escape_string($conn, $WirelessInput['WirelessDate']);
    
    


        $query="UPDATE wirelessNetworkData SET WirelessType = '$WirelessType', WirelessModel = '$WirelessModel',WirelessDate='$WirelessDate'
         WHERE ID = $WirelessID LIMIT 1";
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


function storeWireless($schoolInput){
    global $conn;


    $schoolID=mysqli_real_escape_string($conn, $schoolInput['schoolID']);
    $deviceType=mysqli_real_escape_string($conn, $schoolInput['deviceType']);
    $deviceModel=mysqli_real_escape_string($conn, $schoolInput['deviceModel']);
     $deviceCounter=mysqli_real_escape_string($conn, $schoolInput['deviceCounter']);
      $deviceSource=mysqli_real_escape_string($conn, $schoolInput['deviceSource']);
   //WirelessDate
    

    if(empty(trim($schoolID))){
    return error422('enter schoolID');

    }elseif (empty(trim($deviceType))) {
        return error422('enter deviceType');
        // code...
    }elseif (empty(trim($deviceModel))) {
        return error422('enter deviceModel');
        // code...
    }elseif (empty(trim($deviceCounter))) {
        return error422('enter deviceCounter');
        // code...
    }elseif (empty(trim($deviceSource))) {
        return error422('enter deviceSource');
        // code...
    }
    else
    {
        $query = "INSERT INTO wirelessNetworkData (schoolID,deviceType, deviceModel, deviceCounter,deviceSource) VALUES('$schoolID','$deviceType','$deviceModel',$deviceCounter , '$deviceSource')";
        $result = mysqli_query($conn, $query);

        if($result)
        {
             $data = [
            'status' => 200,
            'message' =>  'Wireless Created Successfully',
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



function deleteWireless($WirelessParams){

    global $conn;

    if(!isset($WirelessParams['ID'])){
        return error422('Wireless ID Not Found in Url');
    }elseif($WirelessParams['ID']==null){
        return error422('Enetr Wireless ID');

    }

    $WirelessID=mysqli_real_escape_string($conn,$WirelessParams['ID']);
   // $duplicaterID=274;

    $query="DELETE FROM wirelessNetworkData WHERE ID=$WirelessID LIMIT 1";

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