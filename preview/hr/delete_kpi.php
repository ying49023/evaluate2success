<?php
    include ('./classes/connection_mysqli.php');
    if(isset($_GET["kpi_id"])){
        $kpi_id = $_GET["kpi_id"];
        
    }
    $sql_del_kpi = "DELETE FROM kpi WHERE kpi_id = '".$kpi_id."' ";
    $sql_del_kpi = "DELETE FROM kpi_group WHERE kpi_id = '".$kpi_id."'";
    
    if (mysqli_query($conn, $sql_del_kpi)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
    
    header("Location: hr_all_kpi_detail.php");
?>

