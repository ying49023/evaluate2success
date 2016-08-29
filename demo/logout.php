<?php
	session_start();
        require_once('./classes/connection_mysqli.php');

	//*** Update Status
	$sql = "UPDATE employees SET login_status = '0', login_datetime = '0000-00-00 00:00:00' WHERE username = '".$_SESSION["username"]."' ";
	$query = mysqli_query($conn,$sql);
        echo $sql;
	session_destroy();
	header("location:login.php");
?>