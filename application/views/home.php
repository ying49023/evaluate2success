<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Coad's school</title>

	<h1>e-dok ros</h1>
	<button id="login">Login</button>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#form").submit(function(event){
				id = $("#empid").val();
				fname = $("#fname").val();
				lname = $("lname").val();
				
				console.log(id);
				console.log(fname);
				console.log(lname);

				$.ajax({
					url:'<?=base_url('Welcome/')?>',
					type: 'POST',
					data: $("#myForm1").serialize(),
					success: function(){
						alert("success");
						$('#email').val('');
						$('#qText').val('');
					},
					error: function(){
						alert("Fail")
					}
				});
				event.preventDefault();

			})
		})

	</script>
</head>
<body>
<form id="form">
	Employee id:<input type="text" name="empid" id="empid"><br>
	First name: <input type="text" name="fname" id="fname"><br>
 	Last name: <input type="text" name="lname" id="lname"><br>
 	<input type="submit" value="submit">
</form>
P'Coad eiei
</body>
</html>