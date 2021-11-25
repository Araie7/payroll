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
                <h1>Edit Employee </h1>
                <div>Edit and update employee details</div>
                <?php echo "<a class='exit-link' href='admin-home.php'>Back</a>";?>
            </div>

            <div class='form-container'>
                <div class="form-inner-container">
                    <div class="form-header">
                        <h2>Employee details</h2>
                    </div>
                
                    <?php 
                    
                    $conn = OpenCon();
                    $sql_query ="SELECT * FROM employees WHERE id = ".$_GET['id'];
                    $result_sql = $conn ->query($sql_query);
                    $row_result = $result_sql->fetch_assoc();
                    echo"

                    
                    <form action='' method='post' id='employee-registration-form'>
                        <label for='id'>ID:</label>
                        <input class='field' id='employee-id' type='text' name='id' placeholder='Employee ID' value='".$row_result['id']."' disabled>

                        <label for='name'>Name:</label>
                        <input class='field' type='text' name='name' placeholder='Employee Name' value='".$row_result['name']."' required>

                        <label for='position'>Position:</label>
                        <select name='position'>
                        <option value='disable' disabled selected>Select position</option>";
                        
                        
                        $sql = "SELECT * FROM positions";
                        $result = $conn ->query($sql);
                        while($row = $result -> fetch_array(MYSQLI_ASSOC)){
                            if($row['position'] == $row_result['position']){
                                echo "<option value='".$row['position']."' selected>".$row['position']."</option>";
                            }else{
                                echo "<option value='".$row['position']."'>".$row['position']."</option>";
                            }
                            
                        }
                        CloseCon($conn);
                    echo"   
                        </select>
                        

                        <label for='email'>Email:</label>
                        <input class='field' type='text' name='email' placeholder='Employee Email' value='".$row_result['email']."'required>

                        <label for='contact'>Contact:</label>
                        <input class='field' type='text' name='contact' placeholder='Employee Contact' value='".$row_result['contact']."'required>

                        <button type='submit' name='submit' class='form-button'>Update</button>
                    </form>";
                     ?>
                    
                </div>
                
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $('#employee-registration-form').on('submit', function (e) {
                    $('#employee-id').prop('disabled', false);
                    e.preventDefault();
                    var dataString = $(this).serialize();
                    $.ajax
                        ({
                            url: 'edit-employee-processing.php',
                            type: 'POST',
                            data: dataString,
                            success: function (msg) {
                                alert(msg);
                            }
                            

                        })
                    $('.employee-id').prop('disabled', true);
                });
            })

        </script>
    </body>
</html>