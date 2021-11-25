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
                <h1>Add Position</h1>
                <div>Add a position title</div>
                <?php echo "<a class='exit-link' href='admin-home.php'>Back</a>";?>
            </div>

            <div class='form-container'>
                <div class="form-inner-container">
                    <div class="form-header">
                        <h2>Add Position</h2>
                    </div>
                
                    <form action="" method="post" id="position-registration-form">
                        <label for="name">Position Name:</label>
                        <input class="field" type="text" name="name" placeholder="Employee Name" required>
                       

                        <button type="submit" name="submit" class="form-button">Add Position</button>
                    </form>
                    
                </div>
                
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $('#position-registration-form').on('submit', function (e) {
                    e.preventDefault();
                    var dataString = $(this).serialize();
                    $.ajax
                        ({
                            url: 'add-position-processing.php',
                            type: 'POST',
                            data: dataString,
                            success: function (msg) {
                                alert(msg);
                                $('.field').val('');
                            }
                            

                        })
                });
            })

        </script>
    </body>
</html>