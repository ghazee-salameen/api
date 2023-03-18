<?php
require '../inc/dbconn.php';

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
                'message' =>  'school data List',
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
