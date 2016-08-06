<?php

include ('./classes/connection_mysqli.php');

if(isset($_POST["kpi_current_group_id"])){
    $get_kpi_group_id = $_POST["kpi_current_group_id"];
}


$sql_update_kpi = " UPDATE kpi k SET kpi_name='".$_POST["kpi_name"]."' , kpi_description='".$_POST["kpi_description"]."', unit = '".$_POST["unit"]."', time_period = '".$_POST["time_period"]."' , kpi_group_id = '".$_POST["kpi_group_id"]."' "
                . " WHERE kpi_id = '".$_POST["kpi_id"]."' ";

    if (mysqli_query($conn, $sql_update_kpi)) {
        echo "New record updated successfully";
        echo $sql_update_kpi;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
header("Location: all_kpi.php?kpi_group_id=$get_kpi_group_id");
?>
