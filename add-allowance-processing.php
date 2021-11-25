<?php
    include "dbConnection.php";

    
    $conn = OpenCon();
    $name = $_POST['name'];
    $amount = $_POST['amount'];

    $sql = "INSERT INTO allowances (allowance_name,allowance_amount) ".
            "VALUES ('$name',$amount);";
    
    if ($conn->query($sql) === TRUE) {
        echo "Successfully added allowance type! ";
       
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    CloseCon($conn);    

?>