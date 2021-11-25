<?php
    include "dbConnection.php";

    
    $conn = OpenCon();
    $name = $_POST['name'];

    $sql = "INSERT INTO positions (position) ".
            "VALUES ('$name');";
    
    if ($conn->query($sql) === TRUE) {
        echo "Successfully added position! ";
       
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    CloseCon($conn);    

?>