<?php
    include "dbConnection.php";

    $conn = OpenCon();
    $month = $_POST['month'];
    $employee_id = $_POST['employee_id'];
    $employee_name = $_POST['employee_name'];
    $epf = $_POST['epf'];
    $socso = $_POST['socso'];
    $final_allowance = $_POST['final_allowance'];

    $sql =  "INSERT INTO payment (month,employee_id,employee_name,epf,socso,final_allowance) ".
    "VALUES ('$month','$employee_id','$employee_name','$epf','$socso','$final_allowance');";
    
    if ($conn->query($sql) === TRUE) {
        echo "Successfully added payment record! ";
       
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    CloseCon($conn);    

?>