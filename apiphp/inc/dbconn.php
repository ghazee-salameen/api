<?php
    //$host  = '95.217.73.102';
	$host  = 'ghazi.in.ps';
    $user  = 'lazar_ghazi';
    $password   = "ghazi@!qwe";
    $database  = "lazar_ghazi";  

    $conn =mysqli_connect($host,$user,$password,$database);

    if(!$conn){
        die("Connection Faild" . mysqli_connect_error());
    }
