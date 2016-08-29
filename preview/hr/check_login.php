<?php
	session_start();

	require_once("./classes/connection_mysqli.php");
        
        if(isset($_POST["submit_login"])){
            $strUsername = mysqli_real_escape_string($conn, $_POST['username']);
            $strPassword = mysqli_real_escape_string($conn, $_POST['password']);

            $strSQL = "SELECT * FROM employees WHERE username = '" . $strUsername . "' 
                and password = '" . $strPassword . "'";
            $objQuery = mysqli_query($conn, $strSQL);
            $objResult = mysqli_fetch_array($objQuery);
            if (!$objResult) {
                echo "Username and Password Incorrect!";
                exit();
            } else {
                if ($objResult["login_status"] == "1") {
                    echo "'" . $strUsername . "' Exists login!";
                    header("location:index.php");
                    exit();
                    
                }else {
                    //*** Update Status Login
                    $sql = "UPDATE employees SET login_status = '1' , login_datetime = NOW() WHERE employee_id = '" . $objResult["employee_id"] . "' ";
                    $query = mysqli_query($conn, $sql);

                    //*** Session
                    $_SESSION["username"] = $objResult["username"];
                    session_write_close();

                    //*** Go to Main page
                    header("location:index.php");
                }
            }
        }else {
            //*** Go to Main page
            header("location:login.php");
        }
	
	mysqli_close($conn);
?>