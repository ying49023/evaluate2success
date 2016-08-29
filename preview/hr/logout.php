<?php
	session_start();
        require_once('./classes/connection_mysqli.php');
//	require_once("./connection.php");

	//*** Update Status
	$sql = "UPDATE user_login SET login_status = '0', login_datetime = '0000-00-00 00:00:00' WHERE username = '".$_SESSION["username"]."' ";
	$query = mysqli_query($con,$sql);

	session_destroy();
	header("location:login.php");
?>