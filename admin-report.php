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
            <h1>Driver Performance</h1>
            <h2>List of trip assigned for each driver</h2>
        </div>
        
        <div class="assign-work-form-outer-container">
            <div class="assign-work-form-container">
                <form action="" method="post" id="add-work-form">
                    
                    <label for="month">Month:</label>
                    <select name="month" id="month">
                        <option value='0' disabled selected>Select month</option>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                        <option value='5'>5</option>
                        <option value='6'>6</option>
                        <option value='7'>7</option>
                        <option value='8'>8</option>
                        <option value='9'>9</option>
                        <option value='10'>10</option>
                        <option value='11'>11</option>
                        <option value='12'>12</option>
                    </select>

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
                </form>
                <button name="generate" class="" id="generate-btn" style="">Generate</button>
                <button name="print" class="" id="print-btn" style="" onclick="printDiv()">Print</button>
            </div>
        </div>

        <div class="table-outer-container">
            <div class="table-container-spacing">
                <div class="table-container assign-work-table" id="payroll-table">
                </div>
            </div>
        </div>
        <?php echo "<a class='exit-link' href='admin-home.php'>Back</a>";?>
        
        <script>
             $('.assign-work-form-container').on('click', '#generate-btn', function (e) {
                var month = $('#month').val();
                var employee_name = $('#employee option:selected').text();
                var employee_id = $('#employee option:selected').val();
                $('.table-container').load('table-payroll.php', {
                    month: month,
                    employee_name: employee_name,
                    employee_id: employee_id
                });
             });

            function printDiv() {
                var divContents = document.getElementById("payroll-table").innerHTML;
                var a = window.open('', '', 'height=500, width=500');
                a.document.write('<html>');
                a.document.write('<body >');
                a.document.write(divContents);
                a.document.write('</body></html>');
                a.document.close();
                a.print();
            }
        </script>
    </body>
    
</html>