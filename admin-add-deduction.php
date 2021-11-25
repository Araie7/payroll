<?php
    session_start();
    include "dbConnection.php";
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
    <body class="table-body assign-work-body">
        <div class="table-header-container">
            <h1>Add Deduction</h1>
            <h2>Add deduction to employees</h2>
        </div>
        
        <div class="assign-work-form-outer-container">
            <div class="assign-work-form-container">
                <form action="" method="post" id="add-work-form">
                    <label for="deduction-id" id="deduction_id_label" style="display:none;">Deduction ID:</label>
                    <input type="number" id="deduction_id_input" name="deduction-id" style="display:none;">

                    <label for="deduction-date">Date:</label>
                    <input type="date" id="deduction-date" name="deduction-date">

                    <label for="employee_id">Name:</label>
                    <select name="employee_id" id="employee">
                        <option value="disable" disabled selected>Select employee</option>
                        <?php
                            $conn = OpenCon();
                            $sql = "SELECT * FROM employees";
                            $result = $conn ->query($sql);
                            while($row = $result -> fetch_array(MYSQLI_ASSOC)){
                                echo "<option value='".$row['id']."'>".$row['name']."</option>";
                            }
                            CloseCon($conn);
                        ?>
                    </select>

                    <label for="deduction-name">Deduction Name:</label>
                    <input type="text" id="deduction-name" name="deduction-name">

                    <label for="deduction-amount">Deduction:</label>
                    <input type="number" id="deduction-amount" name="deduction-amount">

                    <button type="submit" name="submit" class="" id="assign-btn">Save</button>                    

                </form>
                <button name="save" class="" id="save-btn" style="display:none;">Save</button>
                <button name="cancel" class="" id="cancel-btn" style="display:none;">Cancel</button>
            </div>
        </div>

        <div class="table-outer-container">
            <div class="table-container-spacing">
                <div class="table-container assign-work-table">
                </div>
            </div>
        </div>
        <?php echo "<a class='exit-link' href='admin-home.php'>Back</a>";?>
        
        <script>
            function loaddeduction() {
                $('.table-container').load('table-deduction.php');
            }

            $('.table-container').on('click', '.edit-work', function () {
                $('#deduction_id_label').show();
                $('#deduction_id_input').show();
                $('#deduction_id_input').val($(this).attr('id'));
                $('#assign-btn').hide();
                $('#save-btn').show();
                $('#cancel-btn').show();
            });

            $('.assign-work-form-container').on('click', '#save-btn', function (e) {
                var deduction_id = $('#deduction_id_input').val();
                var deduction_date = $('#deduction-date').val();
                var deduction_name = $('#deduction-name').val();
                var employee_name = $('#employee option:selected').text();
                var employee_id = $('#employee option:selected').val();
                var deduction_amount = $('#deduction-amount').val();
                $.ajax
                    ({
                        url: 'update-deduction-processing.php',
                        type: 'POST',
                        data: {
                            deduction_id: deduction_id,
                            deduction_date: deduction_date,
                            deduction_name: deduction_name,
                            employee_name: employee_name,
                            employee_id: employee_id,
                            deduction_amount: deduction_amount
                        },
                        success: function (msg) {
                            alert(msg);
                            $('#deduction_id_label').hide();
                            $('#deduction_id_input').hide();
                            $('#assign-btn').show();
                            $('#save-btn').hide();
                            $('#cancel-btn').hide();
                            loaddeduction();
                        }
                    })
                
            });

            $('.assign-work-form-container').on('click', '#cancel-btn', function (e) {
                $('#deduction_id_label').hide();
                $('#deduction_id_input').hide();
                $('#assign-btn').show();
                $('#save-btn').hide();
                $('#cancel-btn').hide();
            });

            $('#add-work-form').on('submit', function (e) {
                e.preventDefault();
                var dataString = $(this).serialize();
                var employee_name = $('#employee option:selected').text();
                //alert(dataString);
                dataString = dataString.concat("&employee_name=", employee_name);
                //alert(dataString);
                $.ajax
                    ({
                        url: 'add-deduction-processing.php',
                        type: 'POST',
                        data: dataString,
                        success: function (msg) {
                            alert(msg);
                            loaddeduction();
                        }
                    })
            });

            

            $('.table-container').on('click', '.delete-work', function () {
                var target_id = $(this).attr('id');
                $.ajax
                ({
                    url: 'delete-deduction-processing.php',
                    type: 'POST',
                    data: {
                        id: target_id
                    },
                    success: function (msg) {
                        alert(msg);
                        loaddeduction();
                    }
                })
            });

            $(document).ready(function () {
                loaddeduction();

            })
        </script>
    </body>
    
</html>