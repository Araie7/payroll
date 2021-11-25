<?php
    include 'dbConnection.php';

    $conn = OpenCon();
    $query = "SELECT * FROM employees";
    $result = $conn -> query($query);

    
    if ( !empty($result -> num_rows) && $result -> num_rows >0) {
                        
        echo "<table class='table table-bordered'>
                <thead>
                    <tr>
                        <th class='header-left'>Id</th>
                        <th class=''>Name</th>
                        <th class=''>Positiion</th>
                        <th class=''>Email</th>
                        <th class=''>Contact</th>
                        <th class='header-right'>Action</th>
                    </tr>
                </thead>
            <tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "
                <tr>
                    <td>".$row['id']."</td>
                    <td>".$row['name']."</td>
                    <td>".$row['position']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['contact']."</td>
                    <td>
                        <a class='edit-employee' href='edit-employee-form.php?id=".$row['id']."'>Edit</a>
                        <button class='delete-employee' id='".$row['id']."'>Delete</button>
                    </td>
                </tr>

                ";
        }
        echo "</tbody></table>";
        $result->free();
    }else {
        echo "0 results";
    }
    
    Closecon($conn);
?>