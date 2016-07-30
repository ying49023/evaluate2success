<?php

include('./classes/connection_mysqli.php');

if(isset($_GET["emp_id"])){
    $get_emp_id = $_GET["emp_id"];
}

$sql_assign_kpi = "INSERT INTO kpi_responsible (kpi_responsible_id, evaluate_employee_id, kpi_id, goal, percent_weight, success, due_date) 
VALUES (DEFAULT,(SELECT evaluate_employee_id FROM evaluation_employee WHERE employee_id = '".$get_emp_id."' AND evaluation_code = 1),15,10,20,0,'0000-00-00')"

?>
