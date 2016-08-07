<?php

include('./classes/connection_mysqli.php');

if(isset($_POST["emp_id"])){
    $get_emp_id = $_POST["emp_id"];
}

$sql_assign_kpi = "INSERT INTO kpi_responsible (evaluate_employee_id, kpi_id, goal, percent_weight, due_date) 
VALUES ((SELECT evaluate_employee_id FROM evaluation_employee WHERE employee_id = '".$get_emp_id."' AND evaluation_code = 1),".$_POST["kpi_id"].",'".$_POST["goal"]."','".$_POST["weight"]."',CURRENT_TIMESTAMP)";

if(mysqli_query($conn, $sql_assign_kpi)) {
        echo "Record new successfully <br>";
        echo $sql_assign_kpi;
    } else {
        echo "Error new record: " . mysqli_error($conn);
    }
    
//    header("Location: hr_manage_kpi.php?emp_id=$get_emp_id");
?>
