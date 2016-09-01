<?php
    session_start();
    //Check_login
    if($_SESSION["employee_id"]==''){
        echo "Please login again";
        echo "<a href='login.php'>Click Here to Login</a>";
        header("location:login.php");
    }else{
        $now = time(); // Checking the time now when home page starts.
        echo $now." - session expire ".$_SESSION["expire"];
        if ($now > $_SESSION['expire']) {
            session_destroy();
            header("location:session_timeout.php");
            echo "Your session has expired! <a href='login.php'>Login here</a>";
        }else{
            //HTML PAGE
            ?>
<html>
    <head>
        <title>Index</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php include './header.php'; ?>
        <div class="container">
            <div class="box-body">
                <h3 class="text-center">Index</h3>
                <hr>
                <p>Name : <?php  echo $name; ?></p>
                <p>Tel : <?php  echo $tel; ?></p>
                <p>Email : <?php  echo $email; ?></p>
                <p>Position : <?php  echo $position; ?></p>
                <p>Department : <?php  echo $department; ?></p>
            </div>
            <a href="login.php"> Logout</a>
        </div>
        

    </body>
</html>

            <?php
        }
    }

    
?>

