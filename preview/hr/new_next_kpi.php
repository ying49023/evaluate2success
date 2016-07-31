<?php

include ('./classes/connection_mysqli.php');
if(isset($_GET["kpi_id"])){
    $kpi_id = $_GET["kpi_id"];
}
if(isset($_GET["emp_id"])){
    $emp_id = $_GET["emp_id"];
}

$sql_insert= " INSERT INTO next_responsible_kpi (kpi_id, weight , goal) VALUES('".$_POST["kpi_id"]."', '".$_POST["weight"]."', '".$_POST["goal"]."') ";

if (mysqli_query($conn, $sql_insert)) {
       echo "New record created successfully";
   } else {
       echo "Error updating record: " . mysqli_error($conn);
   }

header("Location: hr_approve_kpi2.php?emp_id=".$emp_id);
?>
