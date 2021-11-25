<?php
    include "dbConnection.php";

    
    $conn = OpenCon();
    $date = $_POST['allowance-date'];
    $employee_name = $_POST['employee_name'];
    $employee_id = $_POST['employee_id'];
    $allowance_name = $_POST['allowance_name'];
    $allowance_amount = $_POST['allowance_amount'];
    $extra = $_POST['extra'];
    
    if($extra == "yes"){
        $final = $allowance_amount + 10;
    }else{
        $final = $allowance_amount;
    }
    $sql = "INSERT INTO work (date,employee_id,employee_name,allowance_amount,allowance_name,eligible_extra,total) ".
    "VALUES ('$date',$employee_id,'$employee_name',$allowance_amount,'$allowance_name','$extra',$final);";
    
    
    if ($conn->query($sql) === TRUE) {
        echo "Successfully added work! ";
       
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    CloseCon($conn);    

?>