<?php

include ('./classes/connection_mysqli.php');

$sql_insert="INSERT INTO manage_kpi (kpi_id, department_id, job_id) VALUES('".$_POST["kpi_id"]."','".$_POST["department_id"]."', '".$_POST["job_id"]."')";

if (mysqli_query($conn, $sql_insert)) {
       echo "New record created successfully";
       echo $sql_insert;
   } else {
       echo "Error updating record: " . mysqli_error($conn);
       echo $sql_insert;
   }

header("Location: hr_all_kpi_detail.php");
?>
