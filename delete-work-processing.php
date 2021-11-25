<?php
    include "dbConnection.php";

    
    $conn = OpenCon();

    $id = $_POST['id'];

    $sql = "DELETE FROM work WHERE id = $id;";

    if ($conn->query($sql) === TRUE) {
        echo "Successfully deleted work! ";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
   
    
    
    
    CloseCon($conn);    

?>