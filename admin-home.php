<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Payroll System </title>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="user-home">
        
        <div class="user-home-content">
            <div class="welcome-container">
                <h1 class="welcome-heading">Welcome!</h1>
                <div class="welcome-subtext">Payroll System (Admin)</div>
            </div>
            <div>
                <div class="user-home-items">
                    <div>
                        
                        <a href='admin-add-employee.php'>Add Employee</a>
                        <a href='admin-edit-delete-employee.php'>Edit/Delete Employee</a>
                        <a href='admin-add-position.php'>Add Position</a>
                        <a href='admin-add-allowance.php'>Add New Trip Allowance</a>
                        <a href='admin-assign-work.php'>Assign Work</a>
                        <a href='admin-add-deduction.php'>Add Deduction</a>
                        <a href='admin-calculate-payroll.php'>Calculate Payroll</a>
                        <a href='admin-payroll-record.php'>Payroll Record</a>
                        <a href='admin-report.php'>Driver Performance Report</a>
                    </div>
                    
                    <a href="logout.php">Logout</a>
                </div>
                
            </div>

        </div>
        
    </body>
</html>