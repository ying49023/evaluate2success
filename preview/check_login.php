<?php
session_start();    
include './classes/connection_mysqli.php';

// Variable
$username = $_POST["username"];

$password = $_POST["password"];
if($username == ''){
    echo 'Check username';
}else if($password == ''){
    echo 'Check password';
}else {
    //Query
    $sql = "SELECT * FROM employees WHERE username = '$username' ";
    $query = mysqli_query($conn, $sql);

    //Count data
    $query2 = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($query);
    
    if($num <= 0){
        //No User
        header("location:login.php?check=no_user");
    }else {
        while($result = mysqli_fetch_array($query , MYSQLI_ASSOC)){
            if($result["password"] != $password){
                //Wrong Password
                echo "Password is wrong !";
                header("location:login.php?check=wrong_pass");
            }else if($result["username"] == $username && $result["password"] == $password){
                if($result['login_status'] != '0'){
                    //Limit level
                    echo "Limit level";
                    // send to Admin
                    header("location:login.php?check=limit_level");
                }else { 
                    if ($result['position_level_id'] == '1') {
                        //Admin
                        $_SESSION["employee_id"] = session_id();
                        $_SESSION["username"] = $result["username"];
                        $_SESSION["department_id"] = $result["department_id"];
                        $_SESSION["job_id"] = $result["job_id"];
                        $_SESSION["company_id"] = $result["company_id"];
                        $_SESSION["position_level_id"] = $result["position_level_id"];
                        $_SESSION["login_status"] = $result["login_status"];
                    // send to Employee
                    header("location:myindex.php");
                    } else if ($result['position_level_id'] == '2') {
                        //User
                        $_SESSION["employee_id"] = session_id();
                        $_SESSION["username"] = $result["username"];
                        $_SESSION["department_id"] = $result["department_id"];
                        $_SESSION["job_id"] = $result["job_id"];
                        $_SESSION["company_id"] = $result["company_id"];
                        $_SESSION["position_level_id"] = $result["position_level_id"];
                        $_SESSION["login_status"] = $result["login_status"];
                        // send to Leader
                        header("location:index.php");
                    } else if ($result['position_level_id'] == '3') {
                        //Guest
                        $_SESSION["employee_id"] = session_id();
                        $_SESSION["username"] = $result["username"];
                        $_SESSION["department_id"] = $result["department_id"];
                        $_SESSION["job_id"] = $result["job_id"];
                        $_SESSION["company_id"] = $result["company_id"];
                        $_SESSION["position_level_id"] = $result["position_level_id"];
                        $_SESSION["login_status"] = $result["login_status"];
                        // send to Manager
                        header("location:index.php");
                    } else if ($result['position_level_id'] == '4') {
                        //Guest
                        $_SESSION["employee_id"] = session_id();
                        $_SESSION["username"] = $result["username"];
                        $_SESSION["department_id"] = $result["department_id"];
                        $_SESSION["job_id"] = $result["job_id"];
                        $_SESSION["company_id"] = $result["company_id"];
                        $_SESSION["position_level_id"] = $result["position_level_id"];
                        $_SESSION["login_status"] = $result["login_status"];
                        // send to President
                        header("location:index.php");
                    }
                }
            
            }    
            //Session Timeout Start
            $_SESSION['start'] = time(); // Taking now logged in time.
            // Ending a session in 30 minutes from the starting time. example 30 min = 30*60 / 1 day = 24*60*60
            $_SESSION['expire'] = $_SESSION['start'] + (2*60*60);
        }//end while
    }//end else
    
    //Wrong anything else
    echo "What Wrong please code above !? ";
}
    
?>