<?php
    session_start();
    //Check_login
    if($_SESSION["employee_id"]==''){
        header("location:login.php");
    }else if($_SESSION["position_level_id"] != 2){
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
            <h3 class="text-center">Page 2</h3>
            <hr>
            <p>Email : <?php echo $email; ?></p>
            <p>Tel : <?php echo $tel; ?></p>
        </div>
        </div>
        <a href="page3.php"> page 3</a>
        <a href="logout.php">Logout</a>
        <?php
        include './footer.php';
        ?>
    </body>
</html>

