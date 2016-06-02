<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
	<title>Welcome to Coad's school</title>
	<script type="text/javascript " src="assets/jquery/jquery-2.2.4.min.js" language="javascript"></script>
	<script type="text/javascript">
		
		function goToLogin(){
			window.location.href = '<?=base_url('Welcome/goToLogin')?>';
		}
		$(document).ready(function(){
			$("#form").submit(function(event){				
				// empid=$("#empid").val();
				//fname=$("#fname").val();
				// lname=$("#lname").val();
				// deptid=$("#deptid").val();
				// positionid=$("#positionid").val();
				$.ajax({
					url:"<?=base_url('Welcome/insertValues')?>",
					type: 'post',
					data:$("#form").serialize(),
					success: function(html){
						$('#empja span').append($("#fname").val());
						$('.box-added').css('display','block');
						$('.box-added').slideUp(2000);
					},
					error: function(e){
						alert(e);
					}
				});

				event.preventDefault();
			});
		});
	</script>



	
</head>
<body>
	<div id="main">
	<a href="">P'Coad eiei</a>
	<h1>e-dok ros</h1>

	<a href="<?=base_url('Welcome/goToLogin')?>"><input type="button" value="login" " /></a>


	<button onclick="goToLogin()">asdf</button>
	</div>
	<div id="load"></div>
	<div class="box-added" style="display:none; color:red">
		<p id="empja"> add completedd <span></span></p>
	</div>
	<div>
		<form id="form">
			<input type="text" name="empid" id="empid">
			<input type="text" name="fname" id="fname">
			<input type="text" name="lname" id="lname">
			<input type="text" name="deptid" id="deptid">
			<input type="text" name="positionid" id="positionid">
			<input type="submit" value="submit">
		</form>
	</div>

				<?php
			$servername = "localhost";
			$username = "admin";
			$password = "1234";
			$dbname = "evaluate2successdb";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			     die("Connection failed: " . $conn->connect_error);
			} 

			$sql = "SELECT emp_id, first_name, last_name FROM Employees";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			     echo "<table><tr><th>ID</th><th>Name</th></tr>";
			     // output data of each row
			     while($row = $result->fetch_assoc()) {
			         echo "<tr><td>" . $row["emp_id"]. "</td><td>" . $row["first_name"]. " " . $row["last_name"]. "</td></tr>";
			     }
			     echo "</table>";
			} else {
			     echo "0 results";
			}

			$conn->close();
			?>  
</body>
</html>  n  