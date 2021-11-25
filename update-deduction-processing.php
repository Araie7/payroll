<?php
    include "dbConnection.php";

    
    $conn = OpenCon();

    $deduction_id = $_POST['deduction_id'];
    $deduction_date = $_POST['deduction_date'];
    $employee_name = $_POST['employee_name'];
    $employee_id = $_POST['employee_id'];
    $deduction_name = $_POST['deduction_name'];
    $deduction_amount = $_POST['deduction_amount'];

    $sql = "UPDATE deduction SET date='$deduction_date', employee_id=$employee_id,employee_name='$employee_name',deduction_name = '$deduction_name', deduction_amount=$deduction_amount WHERE id=$deduction_id";

    
    
    if ($conn->query($sql) === TRUE) {
        echo "Successfully updated deduction details! ";
       
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    CloseCon($conn);    

?>