<?php

include ('./classes/connection_mysqli.php');

if(isset($_POST["kpi_group_id"])){
    $sql_kpi = "SELECT * FROM kpi WHERE kpi_group_id = '".$_POST["kpi_group_id"]."'";
    $query = mysqli_query($conn, $sql_kpi);
?>
<option value="">--เลือกKPI--</option>
<?php
    foreach ($query as $kpi){
?>
<option value="<?php echo $kpi["kpi_id"]; ?>">
    <?php echo $kpi["kpi_id"] . " - " . $kpi["kpi_name"]; ?>
</option>
<?php
        
    }
}

?>