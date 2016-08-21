<?php
    include ('./classes/connection_mysqli.php');
    if(isset($_GET["competency_id"])){
        $competency_id = $_GET["competency_id"];
    }
    if(isset($_GET["position_level_id"])){
        $position_level_id = $_GET["position_level_id"];
    }
    
    
    $sql_del_kpi = "DELETE FROM competency WHERE competency_id = '".$competency_id."' ";
    
    if (mysqli_query($conn, $sql_del_kpi)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
    
    header("Location: edit_weight_eval.php?position_level_id=".$position_level_id);
?>

