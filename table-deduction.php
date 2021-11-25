<?php
    include 'dbConnection.php';

    $conn = OpenCon();
    $query = "SELECT * FROM deduction";
    $result = $conn -> query($query);

    
    if ( !empty($result -> num_rows) && $result -> num_rows >0) {
                        
        echo "<table class='table table-bordered'>
                <thead>
                    <tr>
                        <th class='header-left'>Id</th>
                        <th class=''>Date</th>
                        <th class=''>Employee ID</th>
                        <th class=''>Employee Name</th>
                        <th class=''>Deduction Name</th>
                        <th class=''>Deduction Amount</th>
                        <th class='header-right'>Action</th>
                    </tr>
                </thead>
            <tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "
                <tr>
                    <td>".$row['id']."</td>
                    <td>".$row['date']."</td>
                    <td>".$row['employee_id']."</td>
                    <td>".$row['employee_name']."</td>
                    <td>".$row['deduction_name']."</td>
                    <td>".$row['deduction_amount']."</td>
                    <td>
                        <button class='edit-work' id='".$row['id']."'>Edit</button>
                        <button class='delete-work' id='".$row['id']."'>Delete</button>
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