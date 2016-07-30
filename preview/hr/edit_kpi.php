<?php

include ('./classes/connection_mysqli.php');

//header("Location: hr_all_kpi_detail.php");

//$sql_update= " UPDATE kpi k INNER 
//        JOIN kpi_group g ON k.kpi_id = g.kpi_id 
//        SET k.kpi_name'".$_POST["kpi_name"]."', k.kpi_description = '".$_POST["kpi_description"]."', 
//        k.unit = '".$_POST["unit"]."', g.department_id = '".$_POST["job_id"]."', g.job_id = '".$_POST["job_id"]."' 
//        WHERE k.kpi_id ='".$_POST["kpi_id"]."' ";

$sql_update_kpi = " UPDATE kpi k SET kpi_name='".$_POST["kpi_name"]."' , kpi_description='".$_POST["kpi_description"]."', unit = '".$_POST["unit"]."', time_period = '".$_POST["time_period"]."' "
                . " WHERE kpi_id = '".$_POST["kpi_id"]."' ";

    if (mysqli_query($conn, $sql_update_kpi)) {
        echo "New record updated successfully";
        echo $sql_update_kpi;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
$sql_update_kpi_group = " UPDATE kpi_group SET department_id = '".$_POST["department_id"]."', job_id='".$_POST["job_id"]."'  "
                      . " WHERE kpi_id = '".$_POST["kpi_id"]."' ";

    if (mysqli_query($conn, $sql_update_kpi_group)) {
        echo "New record updated successfully";
        echo $sql_update_kpi_group;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }


?>
