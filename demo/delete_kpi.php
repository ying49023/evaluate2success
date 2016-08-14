<?php
    include ('./classes/connection_mysqli.php');
    if(isset($_GET["kpi_id"])){
        $kpi_id = $_GET["kpi_id"];
        
    }
    if(isset($_GET["kpi_group_id"])){
        $kpi_group_id = $_GET["kpi_group_id"];
        
    }
    $sql_del_kpi = "DELETE FROM kpi WHERE kpi_id = '".$kpi_id."' ";
    
    if (mysqli_query($conn, $sql_del_kpi)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
    
    header("Location: all_kpi.php?kpi_group_id=$kpi_group_id");
?>

