<?php
require 'dbconn.php';


function error422($message){
    $data = [
                'status' => 422,
                'message' =>  $message
                
            ];
            header("HTTP/1.0 422 Unprocessable Entry");
            return json_encode($data);
            exit();

}



function getSchools($schoolID)
{
    global $conn;

    $query = "SELECT * FROM users WHERE userName='" . $schoolID . "'";

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {

        if (mysqli_num_rows($query_run) > 0) {
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            $data = [
                'status' => 200,
                'message' =>  'Users List',
                'data' => $res
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' =>  'No User Found',
            ];
            header("HTTP/1.0 404 No User Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' =>  'Internal server Error',
        ];
        header("HTTP/1.0 500 Internal server Error");
        return json_encode($data);
    }
}

function getSchool()
{
    global $conn;

    $query = "SELECT * FROM users ";

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {

        if (mysqli_num_rows($query_run) > 0) {
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            $data = [
                'status' => 200,
                'message' =>  'Users List',
                'data' => $res
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' =>  'No User Found',
            ];
            header("HTTP/1.0 404 No User Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' =>  'Internal server Error',
        ];
        header("HTTP/1.0 500 Internal server Error");
        return json_encode($data);
    }
}

function getAll($table, $schoolID)
{
    global $conn;


    $query = "SELECT * FROM " . $table . " WHERE schoolID='" . $schoolID . "'";

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {

        if (mysqli_num_rows($query_run) > 0) {
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            $data = [
                'status' => 200,
                'message' =>  $table. '  List',
                'data' => $res
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' =>  'No User Found',
            ];
            header("HTTP/1.0 404 No User Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' =>  'Internal server Error',
        ];
        header("HTTP/1.0 500 Internal server Error");
        return json_encode($data);
    }
}


function getSchoolData($schoolID)
{
    global $conn;

    $query = "SELECT * FROM shebronSchoolsTbl WHERE schoolID=$schoolID";

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {

        if (mysqli_num_rows($query_run) > 0) {
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            $data = [
                'status' => 200,
                'message' =>  'Schools List',
                'data' => $res
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' =>  'No school Found',
            ];
            header("HTTP/1.0 404 No school Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' =>  'Internal server Error',
        ];
        header("HTTP/1.0 500 Internal server Error");
        return json_encode($data);
    }
}

function updateSchool($schoolInput,$schoolParams)
{

    global $conn;
    if(!isset($schoolParams['schoolID'])){
        return error422('schoolID Not Found');
    }elseif($schoolParams['schoolID']==null){
        return error422('Enetr schoolID');
    }

    $schoolID=mysqli_real_escape_string($conn, $schoolParams['schoolID']);
    $computerLab=mysqli_real_escape_string($conn, $schoolInput['computerLab']);
    $tecLab=mysqli_real_escape_string($conn, $schoolInput['tecLab']);
    $sinceLab=mysqli_real_escape_string($conn, $schoolInput['sinceLab']);
    $library=mysqli_real_escape_string($conn, $schoolInput['library']);
    $wirelessNetwork=mysqli_real_escape_string($conn, $schoolInput['wirelessNetwork']);
    $attendanceClock=mysqli_real_escape_string($conn, $schoolInput['attendanceClock']);
    $lanNetwork=mysqli_real_escape_string($conn, $schoolInput['lanNetwork']);
    $internet=mysqli_real_escape_string($conn, $schoolInput['internet']);
    $internetSpeed=mysqli_real_escape_string($conn, $schoolInput['internetSpeed']);
     // $columnName='tecLab';
     // $updateValue=1;

     $query="UPDATE shebronSchoolsTbl SET computerLab = $computerLab,tecLab = $tecLab,sinceLab = $sinceLab,library = $library,wirelessNetwork = $wirelessNetwork,attendanceClock=$attendanceClock,lanNetwork=$lanNetwork,internet=$internet,internetSpeed=internetSpeed WHERE schoolID=$schoolID LIMIT 1";
    //$query="UPDATE shebronSchoolsTbl SET tecLab=1 WHERE schoolID=".$schoolID." LIMIT 1";
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


function getCount($table, $schoolID)
{
    global $conn;


    $query = "SELECT count(*) FROM " . $table . " WHERE schoolID='" . $schoolID . "'";

    $query_run = mysqli_query($conn, $query);
    //echo "$query_run";

    if ($query_run) {

        if (mysqli_num_rows($query_run) > 0) {
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            $data = [
                'status' => 200,
                'message' =>  $table. '  List',
                'data' => $res
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' =>  'No User Found',
            ];
            header("HTTP/1.0 404 No User Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' =>  'Internal server Error',
        ];
        header("HTTP/1.0 500 Internal server Error");
        return json_encode($data);
    }
}




