<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
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
</body>
</html>