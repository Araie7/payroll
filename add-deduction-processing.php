<?php
    include "dbConnection.php";

    
    $conn = OpenCon();
    $deduction_date = $_POST['deduction-date'];
    $employee_name = $_POST['employee_name'];
    $employee_id = $_POST['employee_id'];
    $deduction_name = $_POST['deduction-name'];
    $deduction_amount = $_POST['deduction-amount'];
    
    $sql = "INSERT INTO deduction (date,employee_id,employee_name,deduction_name,deduction_amount) ".
    "VALUES ('$deduction_date',$employee_id,'$employee_name','$deduction_name',$deduction_amount);";
    
    
    if ($conn->query($sql) === TRUE) {
        echo "Successfully added deduction! ";
       
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    CloseCon($conn);    

?>