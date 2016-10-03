<?php
require_once("./classes/connection_mysqli.php");

if($_POST["penalty_reward_indicated"] != '') {
	echo $sql ="SELECT * FROM penalty_reward WHERE penalty_reward_indicated = '" . $_POST["penalty_reward_indicated"] . "'";
	$query = mysqli_query($conn, $sql);
?>
	<option value="">--เลือกหัวข้อรางวัล/โทษทางวินัย--</option>
<?php
	foreach($query as $result) {
?>
	<option value="<?php echo $result["penalty_reward_id"]; ?>"><?php echo $result["penalty_reward_name"]; ?>( <?php echo $result["point"]; ?> คะแนน)</option>
<?php
	}
}
?>