<?php
    include ('./classes/connection_mysqli.php');
    
    if(isset($_POST["position_level_id"])){
        $position_level_id = $_POST["position_level_id"];
    }

    $sql_insert_title = "INSERT INTO title (title_name, weight) VALUES ('".$_POST["title_name"]."', '".$_POST["weight"]."')";
    
    if (mysqli_query($conn, $sql_insert_title)) {
        echo "New record successfully";
    } else {
        echo "Error new record: " . mysqli_error($conn);
    }
    
    header("Location: edit_weight_eval.php?position_level_id=$position_level_id");
?>

