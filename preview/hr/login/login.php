<?php 
$value = ''; 
if(isset($_GET["check"])){
    $check = $_GET["check"];
    if($check == 'no_user'){
        $value = "No user please contact admin" ;
    }else if($check == 'wrong_pass'){
        $value = "Password is wrong";
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login Form in PHP with Session</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div id="main">
            <h1>PHP Login Session Example</h1>
            <div id="login">
                <h2>Login Form</h2>
                <form action="check_login.php" method="post">
                    <label>UserName :</label>
                    <input name="username" placeholder="username" type="text" required >
                    <label>Password :</label>
                    <input name="password" placeholder="**********" type="password" required>
                    <input name="submit_login" type="submit" value=" Login ">
                    <span></span>
                </form>
                <p style="color: red;font-weight: 500;"><?php echo $value; ?></p>
            </div>
            <div id="register">
                <br>
                <a href="register.php">Register</a>
            </div>
        </div>
    </body>
</html>