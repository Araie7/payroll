<?php
    session_start();
    include "dbConnection.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Payroll System</title>
        <link rel="stylesheet" href="style.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>

    </head>
    <body class="form-body">

        <div class="form-content-container">
            <div class="text-container">
                <h1>Add Employee</h1>
                <div>Add an employee to the system</div>
                <?php echo "<a class='exit-link' href='admin-home.php'>Back</a>";?>
            </div>

            <div class='form-container'>
                <div class="form-inner-container">
                    <div class="form-header">
                        <h2>Employee details</h2>
                    </div>
                
                    <form action="" method="post" id="employee-registration-form">
                        <label for="name">Name:</label>
                        <input class="field" type="text" name="name" placeholder="Employee Name" required>

                        <label for="position">Position:</label>
                        <select name="position">
                        <option value="disable" disabled selected>Select position</option>
                        
                        <?php
                            $conn = OpenCon();
                            $sql = "SELECT * FROM positions";
                            $result = $conn ->query($sql);
                            while($row = $result -> fetch_array(MYSQLI_ASSOC)){
                                echo "<option value='".$row['position']."'>".$row['position']."</option>";
                            }
                            CloseCon($conn);
                        ?>
                        </select>
                        

                        <label for="email">Email:</label>
                        <input class="field" type="text" name="email" placeholder="Employee Email" required>

                        <label for="contact">Contact:</label>
                        <input class="field" type="text" name="contact" placeholder="Employee Contact" required>

                        <button type="submit" name="submit" class="form-button">Add Employee</button>
                    </form>
                    
                </div>
                
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $('#employee-registration-form').on('submit', function (e) {
                    e.preventDefault();
                    var dataString = $(this).serialize();
                    $.ajax
                        ({
                            url: 'add-employee-processing.php',
                            type: 'POST',
                            data: dataString,
                            success: function (msg) {
                                alert(msg);
                                $('.field').val('');
                                $('#role-field').val('disable');
                            }
                            

                        })
                });
            })

        </script>
    </body>
</html>