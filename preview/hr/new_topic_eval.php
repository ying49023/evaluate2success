<?php

include ('./classes/connection_mysqli.php');

if (isset($_POST["position_level_id"])) {
    $position_level_id = $_POST["position_level_id"];
}

$sql_new = "INSERT INTO competency (title_id,competency_description,weight,expected_level,position_level_id) VALUES 
        ('".$_POST["title_id"]."','".$_POST["competency_description"]."' , '".$_POST["weight"]."' , '".$_POST["expected_level"]."' , '".$_POST["position_level_id"]."')" ;

if (mysqli_query($conn, $sql_new)) {
        echo "New successfully";
    } else {
        echo "Error New record: " . mysqli_error($conn);
    }
    echo $sql_new;
header("Location: edit_weight_eval.php?position_level_id=".$position_level_id);

?>