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
            <h1>Assign Work</h1>
            <h2>Assign trip/route to employees</h2>
        </div>
        
        <div class="assign-work-form-outer-container">
            <div class="assign-work-form-container">
                <form action="" method="post" id="add-work-form">
                    <label for="allowance-id" id="allowance_id_label" style="display:none;">Allowance ID:</label>
                    <input type="number" id="allowance_id_input" name="allowance-id" style="display:none;">

                    <label for="allowance-date">Date:</label>
                    <input type="date" id="allowance-date" name="allowance-date">

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

                    <label for="allowance_amount">Allowance:</label>
                    <select name="allowance_amount" id="allw">
                        <option value="disable" disabled selected>Select allowance</option>
                        <?php
                            $conn = OpenCon();
                            $sql = "SELECT * FROM allowances";
                            $result = $conn ->query($sql);
                            while($row = $result -> fetch_array(MYSQLI_ASSOC)){
                                echo "<option value='".$row['allowance_amount']."'>".$row['allowance_name']."</option>";
                            }
                            CloseCon($conn);
                        ?>
                    </select>
                    <label for="extra"> Eligible for food allowance: </label>
                    <input type="hidden" name="extra" value="no">
                    <input type="checkbox" name="extra" id="extra-box" value="yes">
                    
                    <button type="submit" name="submit" class="" id="assign-btn">Assign</button>
                    

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
            function loadwork() {
                $('.table-container').load('table-assign-work.php');
            }

            $('.table-container').on('click', '.edit-work', function () {
                $('#allowance_id_label').show();
                $('#allowance_id_input').show();
                $('#allowance_id_input').val($(this).attr('id'));
                $('#assign-btn').hide();
                $('#save-btn').show();
                $('#cancel-btn').show();
            });

            $('.assign-work-form-container').on('click', '#save-btn', function (e) {
                var work_id = $('#allowance_id_input').val();
                var work_date = $('#allowance-date').val();
                var employee_name = $('#employee option:selected').text();
                var employee_id = $('#employee option:selected').val();
                var allowance_name = $('#allw option:selected').text();
                var allowance_amount = $('#allw option:selected').val();
                var is_extra = $('#extra-box').is(":checked");
                $.ajax
                    ({
                        url: 'update-work-processing.php',
                        type: 'POST',
                        data: {
                            work_id: work_id,
                            work_date: work_date,
                            employee_name: employee_name,
                            employee_id: employee_id,
                            allowance_name: allowance_name,
                            allowance_amount: allowance_amount,
                            is_extra: is_extra
                        },
                        success: function (msg) {
                            alert(msg);
                            $('#allowance_id_label').hide();
                            $('#allowance_id_input').hide();
                            $('#assign-btn').show();
                            $('#save-btn').hide();
                            $('#cancel-btn').hide();
                            loadwork();
                        }
                    })
                
            });

            $('.assign-work-form-container').on('click', '#cancel-btn', function (e) {
                $('#allowance_id_label').hide();
                $('#allowance_id_input').hide();
                $('#assign-btn').show();
                $('#save-btn').hide();
                $('#cancel-btn').hide();
            });

            $('#add-work-form').on('submit', function (e) {
                e.preventDefault();
                var dataString = $(this).serialize();
                var employee_name = $('#employee option:selected').text();
                var allowance_name = $('#allw option:selected').text();
                //alert(dataString);
                dataString = dataString.concat("&employee_name=", employee_name, "&allowance_name=", allowance_name);
                //alert(dataString);
                $.ajax
                    ({
                        url: 'assign-work-processing.php',
                        type: 'POST',
                        data: dataString,
                        success: function (msg) {
                            alert(msg);
                            loadwork();
                        }
                    })
            });

            

            $('.table-container').on('click', '.delete-work', function () {
                var target_id = $(this).attr('id');
                $.ajax
                ({
                    url: 'delete-work-processing.php',
                    type: 'POST',
                    data: {
                        id: target_id
                    },
                    success: function (msg) {
                        alert(msg);
                        loadwork();
                    }
                })
            });

            $(document).ready(function () {
                loadwork();

            })
        </script>
    </body>
    
</html>