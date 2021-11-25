<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Payroll System</title>
        <link rel="stylesheet" href="style.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>

    </head>
    <body class="table-body">
        <div class="table-header-container">
            <h1>Edit/Delete Employee</h1>
            <h2>Choose an employee to edit or delete</h2>
        </div>
        
        <div class="table-outer-container">
            <div class="table-container-spacing">
                <div class="table-container">
                </div>
            </div>
        </div>
        <?php echo "<a class='exit-link' href='admin-home.php'>Back</a>";?>
        
        <script>
            function loademployee() {
                $('.table-container').load('table-edit-delete-employee.php');
            }

            $('.table-container').on('click', '.delete-employee', function () {
                var target_id = $(this).attr('id');
                $.ajax
                ({
                    url: 'delete-employee-processing.php',
                    type: 'POST',
                    data: {
                        id: target_id
                    },
                    success: function (msg) {
                        alert(msg);
                        loademployee();
                    }
                })
            });

            $(document).ready(function () {
                loademployee();

            })
        </script>
    </body>
    
</html>