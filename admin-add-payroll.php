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
                <h1>Add New Trip Allowance</h1>
                <div>Add trip allowance rate</div>
                <?php echo "<a class='exit-link' href='admin-home.php'>Back</a>";?>
            </div>

            <div class='form-container'>
                <div class="form-inner-container">
                    <div class="form-header">
                        <h2>Trip Allowance details</h2>
                    </div>
                
                    <form action="" method="post" id="allowance-registration-form">
                        <label for="name">Trip/Route Name:</label>
                        <input class="field" type="text" name="name" placeholder="Allowance Name" required>

                        <label for="amount">Trip Allowance Amount(RM):</label>
                        <input class="field" type="number" name="amount" placeholder="Allowance Amount" required>

                        <button type="submit" name="submit" class="form-button">Add New Trip</button>
                    </form>
                    
                </div>
                
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $('#allowance-registration-form').on('submit', function (e) {
                    e.preventDefault();
                    var dataString = $(this).serialize();
                    $.ajax
                        ({
                            url: 'add-allowance-processing.php',
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