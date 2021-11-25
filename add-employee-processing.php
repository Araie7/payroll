<?php
    include "dbConnection.php";

    
    $conn = OpenCon();
    // username and password sent from form     
    $name = $_POST['name'];
    $position = $_POST['position'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $sql = "INSERT INTO employees (name,position,email,contact) ".
            "VALUES ('$name','$position','$email','$contact');";
    
    if ($conn->query($sql) === TRUE) {
        echo "Successfully added employee! ";
       
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    CloseCon($conn);    

?>