<?php
    include ('./classes/connection_mysqli.php');
    if(isset($_GET["manage_kpi_id"])){
        $manage_kpi_id = $_GET["manage_kpi_id"];
        
    }
    if(isset($_GET["department_id"])){
        $department_id = $_GET["department_id"];
        
    }
    if(isset($_GET["job_id"])){
        $job_id = $_GET["job_id"];
        
    }
    $sql_del_kpi = "DELETE FROM manage_kpi WHERE manage_kpi_id = '".$manage_kpi_id."'";
    
    if (mysqli_query($conn, $sql_del_kpi)) {
        echo "Record deleted successfully";
        echo $sql_del_kpi;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
        echo $sql_del_kpi;
    }
    
    header("Location: hr_all_kpi_detail.php?department_id=$department_id&job_id=$job_id");
?>

