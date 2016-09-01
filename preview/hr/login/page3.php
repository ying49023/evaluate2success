<?php
    session_start();
    //Check_login
    if($_SESSION["employee_id"]==''){
        header("location:login.php");
    }else if($_SESSION["position_level_id"] != 3){
        header("location:logout.php");
    }else{
        
    }
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
            <h3 class="text-center">Page 3</h3>
            <hr>
            <p>User : <?php echo $name; ?></p>
        </div>
        </div>
        <a href="page2.php">Page 2</a>
        <a href="logout.php">Logout</a>
        <?php include './footer.php'; ?>
    </body>
</html>

