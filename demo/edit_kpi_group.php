<?php

include ('./classes/connection_mysqli.php');

if (isset($_POST["manage_kpi_id"])) {
    $manage_kpi_id = $_POST["manage_kpi_id"];
}
if (isset($_POST["post_department_id"])) {
    $post_department_id = $_POST["post_department_id"];
}
if (isset($_POST["post_job_id"])) {
    $post_job_id = $_POST["post_job_id"];
}

$sql_update_kpi_group = " UPDATE manage_kpi SET department_id = '".$_POST["department_id"]."', job_id='".$_POST["job_id"]."'  "
                      . " WHERE manage_kpi_id = '".$manage_kpi_id."' ";

    if (mysqli_query($conn, $sql_update_kpi_group)) {
        echo "New record updated successfully";
        echo $sql_update_kpi_group;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    header("Location: hr_all_kpi_detail.php?department_id=$post_department_id&job_id=$post_job_id");

?>
