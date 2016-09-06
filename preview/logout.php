<?php

session_start();

unset($_SESSION['employee_id']);
unset($_SESSION['username']);
unset($_SESSION['position_level_id']);

session_destroy();
header("location:login.php")
?>