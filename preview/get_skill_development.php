<?php
require_once("./classes/connection_mysqli.php");

if($_POST["skill_dev_group_id"] != '') {
	echo $sql ="SELECT * FROM skill_development WHERE skill_dev_group_id = '" . $_POST["skill_dev_group_id"] . "'";
	$query = mysqli_query($conn, $sql);
?>
	<option value="" >--เลือก--</option>
<?php
	foreach($query as $result) {
?>
	<option value="<?php echo $result["skill_development_id"]; ?>"><?php echo $result["skill_development_name"]; ?></option>
<?php
	}
}
?>

