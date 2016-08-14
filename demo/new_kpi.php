<?php

include ('./classes/connection_mysqli.php');

$sql_insert= " INSERT INTO kpi (kpi_name, kpi_description, unit,time_period,kpi_group_id) VALUES('".$_POST["kpi_name"]."', '".$_POST["kpi_description"]."', '".$_POST["unit"]."','".$_POST["time_period"]."','".$_POST["kpi_group_id"]."') ";


if (mysqli_query($conn, $sql_insert)) {
       echo "New record created successfully";
   } else {
       echo "Error updating record: " . mysqli_error($conn);
   }

header("Location: all_kpi.php");
?>