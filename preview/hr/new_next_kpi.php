<?php

include ('./classes/connection_mysqli.php');
if(isset($_POST["kpi_id"])){
    $kpi_id = $_POST["kpi_id"];
}
if(isset($_POST["emp_id"])){
    $emp_id = $_POST["emp_id"];
}

$sql_insert= " INSERT INTO next_responsible_kpi (
	next_responsible_kpi_id,
	kpi_id,
	evaluate_next_kpi_id,
	goal,
	weight,
	approval
)
VALUES
	(
		DEFAULT,
		'".$_POST["kpi_id"]."',
		(
			SELECT
				evaluate_next_kpi_id
			FROM
				evaluation_next_kpi
			WHERE
				evaluate_employee_id = (
					SELECT
						evaluate_employee_id
					FROM
						evaluation_employee
					WHERE
						employee_id = '".$emp_id."'
					AND evaluation_code = 1
				)
		),
		'".$_POST["goal"]."',
		'".$_POST["weight"]."',
		1
	) ";

if (mysqli_query($conn, $sql_insert)) {
       echo "New record created successfully";
   } else {
       echo "Error updating record: " . mysqli_error($conn);
   }

header("Location: hr_approve_kpi2.php?emp_id=".$emp_id);
?>
