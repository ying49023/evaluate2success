<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Coad's school</title>
<<<<<<< HEAD

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
=======
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
>>>>>>> 4ab98aa8140efe59215ac9121b5c151e437a3c08
</body>
</html>