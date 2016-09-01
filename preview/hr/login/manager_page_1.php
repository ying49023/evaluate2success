<?php 
session_start();
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
            <p>Email : <?php echo $email ?></p>
            <p></p>
        </div>
        </div>
        <a href="index.php">Page 2</a>
        <a href="logout.php">Logout</a>
        <?php include './footer.php'; ?>
    </body>
</html>

