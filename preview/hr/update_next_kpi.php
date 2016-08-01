<?php
    include ('./classes/connection_mysqli.php');
   
    if(isset($_POST["emp_id"])){
        $emp_id  = $_POST["emp_id"];
    }
    
    if(isset($_POST["next_responsible_kpi_id"])){
        $next_responsible_kpi_id = $_POST["next_responsible_kpi_id"];
    }
    
    $sql_del_kpi = "UPDATE next_responsible_kpi 
                    SET goal = '".$_POST["goal"]."' ,weight = '".$_POST["weight"]."'
                    WHERE next_responsible_kpi_id = '".$next_responsible_kpi_id."'";
    
    if (mysqli_query($conn, $sql_del_kpi)) {
        echo "Record updated successfully";
    } else {
        echo "Error updated record: " . mysqli_error($conn);
    }
    
    header("Location: hr_approve_kpi2.php?emp_id=".$emp_id);
?>

