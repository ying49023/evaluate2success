<?php

include ('./classes/connection_mysqli.php');

if (isset($_POST["position_level_id"])) {
    $position_level_id = $_POST["position_level_id"];
}

$sql_update = "UPDATE competency SET weight = '".$_POST["weight"]."',expected_level = '".$_POST["expected_level"]."' WHERE competency_id = '".$_POST["competency_id"]."'" ;

if (mysqli_query($conn, $sql_update)) {
        echo "Update successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
    echo $sql_update;
header("Location: edit_weight_eval.php?position_level_id=$position_level_id");

?>