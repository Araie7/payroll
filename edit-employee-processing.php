<?php
    include "dbConnection.php";

    
    $conn = OpenCon();

    $id = $_POST['id'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $sql = "UPDATE employees SET name='$name', position='$position',email='$email',contact='$contact' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Successfully updated employee details! ";
       
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    CloseCon($conn);    

?>