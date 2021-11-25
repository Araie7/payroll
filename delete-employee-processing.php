<?php
    include "dbConnection.php";

    
    $conn = OpenCon();

    $id = $_POST['id'];

    $sql = "DELETE FROM employees WHERE id = $id;";

    if ($conn->query($sql) === TRUE) {
        echo "Successfully deleted employee! ";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
   
    
    
    
    CloseCon($conn);    

?>