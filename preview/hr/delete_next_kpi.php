<?php
    include ('./classes/connection_mysqli.php');
    
    if(isset($_GET["next_responsible_kpi_id"])){
        $next_responsible_kpi_id = $_GET["next_responsible_kpi_id"];
    }
    
    if(isset($_GET["emp_id"])){
        $emp_id  = $_GET["emp_id"];
    }
    
    $sql_del_kpi = "DELETE FROM next_responsible_kpi WHERE next_responsible_kpi_id = '".$next_responsible_kpi_id."'";
    
    if (mysqli_query($conn, $sql_del_kpi)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
    
    header("Location: hr_approve_kpi2.php?emp_id=".$emp_id);
?>

