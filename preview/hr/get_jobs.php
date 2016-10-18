<?php
require_once("./classes/connection_mysqli.php");

if($_POST["department_id"] != '') {
	echo $sql ="SELECT * FROM jobs WHERE department_id = '" . $_POST["department_id"] . "'";
	$query = mysqli_query($conn, $sql);
?>
	<option value="">--เลือกตำแหน่ง--</option>
<?php
	foreach($query as $result) {
?>
	<option value="<?php echo $result["job_id"]; ?>"><?php echo $result["job_name"]; ?></option>
<?php
	}
}
?>