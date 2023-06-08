<?php
	include "connection.php";
	include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		Update Password
	</title>
	<style type="text/css">
		body{
			
			height: 700px;
			background-color: #6cc2bf;
			background-image: url("images/up.jpg");
			
		}
		.wrapper{
			width: 500px;
			height: 500px;
			margin: 0 auto;
			
			color: black;
			padding: 100px 15px;
		}
		.form-control
		{
			width: 350px;
		}
	</style>
</head>
<body>
	<div class="wrapper">
		<div style="text-align: center;">
		
		<h1 style="text-align: center; font-size: 35px; font-family: Lucida Console;"><b>Change Your Password</b></h1>	
		</div>
		<div style="padding-left: 60px;">
		<form action="" method="post">
			<input type="text" name="Username" class="form-control" placeholder="Username" required=""><br>
			<input type="text" name="email" class="form-control" placeholder="Email" required=""><br>
			<input type="text" name="password" class="form-control" placeholder="New Password" required=""><br>
			<button class="btn btn-default" type="submit" name="submit">Update</button>
		</form>
		</div>
	</div>
	<?php
		if(isset($_POST['submit'])){
			if($sql=mysqli_query($db,"UPDATE student SET password='$_POST[password]' WHERE Username='$_POST[Username]' AND email='$_POST[email]' ;"))
			{
	?>
	<script type="text/javascript">
		alert("This Password Updated Successfully...")
	</script>

	<?php
			}
		}
	?>

</body>
</html>