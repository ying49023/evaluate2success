<?php
require_once("./classes/connection_mysqli.php");

if($_POST["kpi_id"] != '') {
	echo $sql ="SELECT * FROM kpi WHERE kpi_id = '" . $_POST["kpi_id"] . "'";
	$query = mysqli_query($conn, $sql);
?>
	<option value="" >--เลือก--</option>
<?php
	foreach($query as $result) {
?>
	
<?php
	}
}
?>



