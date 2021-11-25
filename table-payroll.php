<?php
    include 'dbConnection.php';

    $conn = OpenCon();
    $month = $_POST['month'];
    $employee_id = $_POST['employee_id'];
    $query = "SELECT * FROM work WHERE is_paid = 1 AND MONTH(date) = $month AND employee_id = $employee_id";
    $result = $conn -> query($query);

    
    if ( !empty($result -> num_rows) && $result -> num_rows >0) {
                        
        echo "<table class='table table-bordered'>
                <thead>
                    <tr>
                        <th class='header-left'>Name</th>
                        <th class=''>Date</th>
                        <th class=''>Trip ID</th>
                        <th class=''>Trip</th>
                        <th class=''>Amount</th>
                        <th class=''>Food Allowance</th>
                        <th class='header-right'>Total</th>
                    </tr>
                </thead>
            <tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "
                <tr>
                    <td>".$row['employee_name']."</td>
                    <td>".$row['date']."</td>
                    <td>".$row['id']."</td>
                    <td>".$row['allowance_name']."</td>
                    <td>".$row['allowance_amount']."</td>
                    <td>".$row['eligible_extra']."</td>
                    <td>".$row['total']."</td>
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