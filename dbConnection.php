<?php


function OpenCon(){
	$username = "root";
    $password = "";
    $database = "payroll";
    $host = "localhost";
    $mysqli = new mysqli($host, $username, $password, $database);
    
    if ($mysqli -> connect_error){
        die("Connection failed: ". $mysqli -> connect_error);
    } 
    return $mysqli;
}

function CloseCon($conn){
    $conn -> close();
}
?>