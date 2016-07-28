<?php

include ('./classes/connection_mysqli.php');

header("Location: hr_all_kpi_detail.php");

//$sql_insert = "BEGIN;
//INSERT INTO kpi (kpi_name, kpi_description, unit)
//  VALUES('".$_POST["kpi_name"]."', '".$_POST["kpi_description"]."', '".$_POST["unit"]."');
//INSERT INTO kpi_group (kpi_id, department_id, job_id) 
//  VALUES(LAST_INSERT_ID(),'".$_POST["department_id"]."', '".$_POST["job_id"]."');
//COMMIT;";
$sql_insert= " INSERT INTO kpi (kpi_name, kpi_description, unit,time_period) VALUES('".$_POST["kpi_name"]."', '".$_POST["kpi_description"]."', '".$_POST["unit"]."','".$_POST["time_period"]."') ";
mysqli_query($conn, $sql_insert);
$kpi_id= mysqli_insert_id($conn);

if(!empty($kpi_id)) {

$sql_insert="INSERT INTO kpi_group (kpi_id, department_id, job_id) VALUES(LAST_INSERT_ID(),'".$_POST["department_id"]."', '".$_POST["job_id"]."')";
/* or 
 $sql=INSERT INTO profiles (userid, bio, homepage) VALUES(LAST_INSERT_ID(),'Hello   world!', 'http://www.stackoverflow.com'); */
    
}
if (mysqli_query($conn, $sql_insert)) {
       echo "New record created successfully";
   } else {
       echo "Error updating record: " . mysqli_error($conn);
   }


?>
