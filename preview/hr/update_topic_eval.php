<?php

include ('./classes/connection_mysqli.php');

$sql_update = "UPDATE competency SET weight = '".$_POST["weight"]."',expected_level = '".$_POST["expected_level"]."' WHERE competency_id = '".$_POST["competency_id"]."'" ;

if (mysqli_query($conn, $sql_update)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
    echo $sql_update;
//header("Location: hr_all_kpi_detail.php");

?>