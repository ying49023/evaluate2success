<?php
    include ('./classes/connection_mysqli.php');
    
    if(isset($_GET["position_level_id"])){
        $position_level_id = $_GET["position_level_id"];
    }

    $sql_delete_title = "DELETE FROM title WHERE title_id = '".$_GET["title_id"]."' ";
    
    if (mysqli_query($conn, $sql_delete_title)) {
        echo "delete record successfully";
    } else {
        echo "Error delete record: " . mysqli_error($conn);
    }
    
    header("Location: edit_weight_eval.php?position_level_id=$position_level_id");
?>

