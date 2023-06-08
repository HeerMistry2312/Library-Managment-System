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
		Edit profile
	</title>
	<style type="text/css">
		.form-control
		{
			width: 400px;
			height: 35px;	
		}
		form{
			padding-left: 570px;
		}
	</style>
</head>
<body style="background-color: #6cc2bf;">

	<h3 style="text-align: center;"><b>Edit Information</b></h3>
	<?php
		$sql = "SELECT * FROM student WHERE Username='$_SESSION[login_user]'";
		$result = mysqli_query($db,$sql) or die (mysql_error());

		while($row = mysqli_fetch_assoc($result))
		{
			$first=$row['first'];
			$last=$row['last'];
			$Username=$row['Username'];
			$password=$row['password'];
			$email=$row['email'];
			$phone=$row['phone'];
		}
	?>
	<div class="profile_info" style="text-align: center;">
		<span>Welcome,</span>
		<h4><?php echo $_SESSION['login_user']; ?></h4>
	</div>
	<div class="form1">
	<form accept="" method="post" enctype="multipart/form-data">
		<input class="form-control" type="file" name="file">
		<label><h5><b>First Name: </b></h5></label>
		<input class="form-control" type="text" name="first" value="<?php echo $first; ?>">
		<label><h5><b>Last Name: </b></h5></label>
		<input class="form-control" type="text" name="last" value="<?php echo $last; ?>">
		<label><h5><b>Username: </b></h5></label>
		<input class="form-control" type="text" name="Username" value="<?php echo $Username; ?>">
		<label><h5><b>Password: </b></h5></label>
		<input class="form-control" type="text" name="password" value="<?php echo $password; ?>">
		<label><h5><b>E-mail: </b></h5></label>
		<input class="form-control" type="text" name="email" value="<?php echo $email; ?>">
		<label><h5><b>Phone No: </b></h5></label>
		<input class="form-control" type="text" name="phone" value="<?php echo $phone; ?>"><br>
		<div style="padding-left: 160px;"><button class="btn btn-default" type="submit" name="submit">SAVE</button></div>
	</form>
	</div>
<?php
	if(isset($_POST['submit']))
	{
		move_uploaded_file($_FILES['file']['tmp_name'],"images/".$_FILES['file']['name']);
		$first=$_POST['first'];
		$last=$_POST['last'];
		$Username=$_POST['Username'];
		$password=$_POST['password'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$pic=$_FILES['file']['name'];

		$sql1="UPDATE student SET pic='$pic', first='$first', last='$last', Username='$Username', password='$password', email='$email', phone='$phone' WHERE Username='".$_SESSION['login_user']."';";
		if(mysqli_query($db,$sql1))
		{
			?>
			<script type="text/javascript">
				alert("Saved Successfully...");
				window.location="profile.php";
			</script>
			<?php
		}
	}
?>
</body>
</html>