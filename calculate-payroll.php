<?php
    include 'dbConnection.php';

    $month = $_POST['month'];
    $employee_name = $_POST['employee_name'];
    $employee_id = $_POST['employee_id'];
    $is_permanent = $_POST['is_permanent'];

    $total_allowance = 0;
    $total_deduction = 0;
    $num_of_allowance = 0;
    $permanent_allowance = 0;
    $init_allowance = 0.0;
    $final_allowance = 0.0;

    $conn = OpenCon();

    $query = "SELECT * FROM work WHERE MONTH(date) = $month AND employee_id = $employee_id";
    $result = $conn -> query($query);
    if ( !empty($result -> num_rows) && $result -> num_rows >0) {
                        
        while ($row = $result->fetch_assoc()) {
            $total_allowance += $row['total'];
            $num_of_allowance ++;
        }
        $result->free();
    }else {
        //echo "0 results";
    }
    $permanent_allowance = 40*$num_of_allowance;

    $query = "SELECT * FROM deduction WHERE MONTH(date) = $month AND employee_id = $employee_id";
    $result = $conn -> query($query);
    if ( !empty($result -> num_rows) && $result -> num_rows >0) {
                        
        while ($row = $result->fetch_assoc()) {
            $total_deduction += $row['deduction_amount'];
        }
        $result->free();
    }else {
        //echo "0 results";
    }

    if($is_permanent == 'true'){
        $init_allowance = $total_allowance - $total_deduction + 1000;
        $permanent_allowance = 1000;
    }else{
        $init_allowance = $total_allowance - $total_deduction + $permanent_allowance;
    }
    $allowance_notdeduct = $init_allowance + $total_deduction;
    $epf = $allowance_notdeduct * 12/100;
    $socso = $allowance_notdeduct * 0.5/100;
    $allowance_afterepf = $allowance_notdeduct - $epf - $socso;
    $final_allowance = $allowance_afterepf - $total_deduction;
    echo "
        <div style='text-align: right;' id='pay-calculation'>
            <div>Pancaran Matahari (M) Sdn. Bhd.</div>       
            <div>No 241. Jalan Shahab 2, Shahab Perdana</div>    
            <div>05150 Alor Setar, Kedah Darul Aman</div>    
            <div>Tel: 604-7208388/8389 Fax: 604-7208387</div>    
            <div>Payslip for $employee_name</div>
            <div>for month of $month</div>
            <div>______________________</div>
            <br>
            <div>Total Trip Allowance: $total_allowance</div>
            <div>Adjustment: + $permanent_allowance</div>
            <div>______________________</div>
            <div>Salary Before EPF & SOCSO: $allowance_notdeduct</div>
            <div>- 12% EPF: $epf</div>
            <div>- 0.05% SOCSO: $socso</div>
            <div>______________________</div>
            <div>Salary After EPF & SOCSO: $allowance_afterepf</div>
            <div>Other Deduction: ($total_deduction)</div>
            <div>______________________</div>
            <div>$final_allowance</div>
            <br>
            <div>NOTE:</div>
            <div>*Adjustment = If permanent employee, get additional RM1,000. If temporary employee, get additional RM40 per trip.</div>
        </div>
        
        <button class='pay' id='$final_allowance' style='float:right;' onclick='payFunc($employee_id,$month)'>Pay</button>
        <button class='save2' id='$final_allowance' style='float:right;' onclick='save2Func($month,$employee_id,$employee_name,$epf,$socso,$final_allowance)'>Save Record</button>
        <button style='float:right;'>Authorize</button>

        <script>
            function payFunc(employee_id,month){
                $.ajax
                    ({
                        url: 'pay-allowance-processing.php',
                        type: 'POST',
                        data: {
                            employee_id: employee_id,
                            month: month
                        },
                        success: function (msg) {
                            alert(msg);
                        }
                    })
            }
            function save2Func(month,employee_id,employee_name,epf,socso,final_allowance){
                $.ajax
                    ({
                        url: 'add-payroll-processing.php',
                        type: 'POST',
                        data: {
                            month: month,
                            employee_id: employee_id,
                            employee_name: employee_name,
                            epf: epf,
                            socso: socso,
                            final_allowance: final_allowance
                        },
                        success: function (msg) {
                            alert(msg);
                        }
                    })
            }
        </script>
    ";


    Closecon($conn);
?>