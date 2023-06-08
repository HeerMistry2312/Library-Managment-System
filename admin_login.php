<?php
	include "connection.php";
	include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Student Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewpot" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style type="text/css">
	section
	{
		margin-top: -20px;

	}
</style>

</head>
<body>
<section>
		<div class="log_img">
			<br><br><br>
			<div class="box1">
				<h1 style="text-align: center; font-size: 35px; font-family: Lucida Console;">Library Managment System</h1>
				<h1 style="text-align: center; font-size: 25px; ">User Login</h1>
				<form name="login" action="" method="post">
					
					<div class="login">
					<input class="form-control" type="text" name="Username" placeholder="Username" required=""><br>
					<input class="form-control" type="password" name="password"placeholder="Password" required=""><br>
					<input class="btn btn-default" type="submit" name="submit" value="Login" style="color: black; width: 80px; height: 30px;">
					</div>
				</form>
				<p style="color: white; padding-left: 15px;"><br>
					&nbsp &nbsp &nbsp  &nbsp<a style="color: white;" href="update_password.php">forgot Password?
					</a> &nbsp  &nbsp &nbsp  
					New to this Website? &nbsp<a style="color: white;" href="registration.php">Sign Up</a>
				</p>
			</div>
		</div>
		
</section>
<?php
	if(isset($_POST['submit']))
	{
		$count=0;
		$res=mysqli_query($db,"SELECT * FROM `admin` WHERE Username='$_POST[Username]' && password='$_POST[password]';");
		$row=mysqli_fetch_assoc($res);
		$count=mysqli_num_rows($res);
		if($count==0){
?>
<script type="text/javascript">
	alert("The Username and Password does not match...");
</script>

<?php
		}
		else{
		/*IF username and password matches*/
			$_SESSION['login_user'] = $_POST['Username'];
			$_SESSION['pic'] = $row['pic'];
			$_SESSION['Username']=='';

?>
			<script type="text/javascript">
				window.location="index.php"
			</script>
<?php
		}

	}
?>

</body>
</html>