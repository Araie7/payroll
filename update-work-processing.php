<?php
    include "dbConnection.php";

    
    $conn = OpenCon();

    $work_id = $_POST['work_id'];
    $work_date = $_POST['work_date'];
    $name = $_POST['employee_name'];
    $employee_id = $_POST['employee_id'];
    $allowance_name = $_POST['allowance_name'];
    $allowance_amount = $_POST['allowance_amount'];
    $is_extra = $_POST['is_extra'];

    if($is_extra == "true"){
        $final = $allowance_amount + 10;
        $sql = "UPDATE work SET date='$work_date', employee_id='$employee_id',employee_name='$name',allowance_amount=$allowance_amount,allowance_name='$allowance_name',eligible_extra='yes',total=$final WHERE id=$work_id";
    }else{
        $sql = "UPDATE work SET date='$work_date', employee_id='$employee_id',employee_name='$name',allowance_amount=$allowance_amount,allowance_name='$allowance_name',eligible_extra='yes',total=$allowance_amount WHERE id=$work_id";
    }
    
    
    if ($conn->query($sql) === TRUE) {
        echo "Successfully updated work details! ";
       
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    CloseCon($conn);    

?>