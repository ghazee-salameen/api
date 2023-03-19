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


function updateAttendance($AttendanceInput,$AttendanceParams)
{

    global $conn;
    if(!isset($AttendanceParams['ID'])){
        return error422('AttendanceID Not Found');
    }elseif($AttendanceParams['ID']==null){
        return error422('Enetr AttendanceID');
    }

    $AttendanceID=mysqli_real_escape_string($conn,$AttendanceParams['ID']);
    
    $AttendanceType=mysqli_real_escape_string($conn, $AttendanceInput['attendanceType']);
   
    


        $query="UPDATE attendanceTbl SET attendanceType = '$AttendanceType' WHERE ID = $AttendanceID LIMIT 1";
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


function storeAttendance($schoolInput){
    global $conn;


    $schoolID=mysqli_real_escape_string($conn, $schoolInput['schoolID']);
    $AttendanceType=mysqli_real_escape_string($conn, $schoolInput['attendanceType']);
    $AttendanceExist=mysqli_real_escape_string($conn, $schoolInput['attendanceExist']);
   

    if(empty(trim($schoolID))){
    return error422('enter schoolID');

    }elseif (empty(trim($AttendanceType))) {
        return error422('enter AttendanceType');
        // code...
    }elseif (empty(trim($AttendanceExist))) {
        return error422('enter AttendanceExist');
        // code...
    }else
    {
        $query = "INSERT INTO attendanceTbl (schoolID,attendanceType,attendanceExist) VALUES('$schoolID','$AttendanceType','$AttendanceExist')";
        $result = mysqli_query($conn, $query);

        if($result)
        {
             $data = [
            'status' => 200,
            'message' =>  'Attendance Created Successfully',
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



function deleteAtt($AttendanceParams){

    global $conn;

    if(!isset($AttendanceParams['ID'])){
        return error422('Attendance ID Not Found in Url');
    }elseif($AttendanceParams['ID']==null){
        return error422('Enetr Attendance ID');

    }

    $AttendanceID=mysqli_real_escape_string($conn,$AttendanceParams['ID']);
   // $AttendanceID=274;

    $query="DELETE FROM attendanceTbl WHERE ID=$AttendanceID LIMIT 1";

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
                'message' => 'Attendance Not Found'
                
            ];
            header("HTTP/1.0 404 Attendance Not Found");
            return json_encode($data);

    }



}