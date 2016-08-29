<?php
/*
 * For more details
 * please check official documentation of DataTables  https://datatables.net/manual/server-side
 * Coded by charaf JRA
 * RefreshMyMind.com
 */

    /*
     * Database Configuration and Connection using mysqli
     */
    $serverName = "103.27.202.37";
	$userName = "prasukrit_alt";
	$userPassword = "13579alt";
	$dbName = "prasukrit_evaluate2success";
        
	//$myTable = "project";

	// Check connection
	
	// Create connection
	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);

	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

    mysqli_set_charset($conn, "utf8"); // Change latin charset to UTF-8 charset for MSQL
    /* END DB Config and connection */
    
    //*** Reject user not online
    $intRejectTime = 1; // Minute
    $sql = "UPDATE employees SET login_status = '0', login_datetime = '0000-00-00 00:00:00'  WHERE 1 AND DATE_ADD(LastUpdate, INTERVAL $intRejectTime MINUTE) <= NOW() ";
    $query = mysqli_query($conn,$sql);
    
?>
	
