<?php
include './classes/connection_mysqli.php';

session_start();

echo $_SESSION["emp_id"] = $_POST["emp_id"];
echo $_SESSION["position"] = $_POST["position"];
echo $_SESSION["eval_emp_id"] = $_POST["eval_emp_id"];
echo $_SESSION["eval_code"] = $_POST["eval_code"];
echo $_SESSION["comp_id"] = $_POST["comp_id"];
header("location:explan_evaluation.php");

?>
