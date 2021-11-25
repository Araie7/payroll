<?php
    include "dbConnection.php";

    
    $conn = OpenCon();


    $employee_id = $_POST['employee_id'];
    $month = $_POST['month'];

    $sql = "UPDATE work SET is_paid=1 WHERE employee_id=$employee_id AND MONTH(date)=$month";    
    
    if ($conn->query($sql) === TRUE) {
        echo "Successfully paid! ";
       
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    CloseCon($conn);   

?>