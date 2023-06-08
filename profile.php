<?php
	include "connection.php";
	include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile</title>
	<style type="text/css">
		.wrapper{
			width: 500px;
			height: 600px;
			margin: 0 auto;
			background-color: white;
			opacity: .7;
			color: black;
		}
	</style>
</head>
<body style="background-color: #6cc2bf;">
	<div class="container">
		<form action="" method="post">
			<button class="btn btn-default" style="float: right;width: 70px;" name="submit1">Edit</button>
		</form>
		<div class="wrapper" style="">

		<?php
		if(isset($_POST['submit1'])){
				?>
				<script type="text/javascript">
					window.location="edit.php"
				</script>
				<?php
			}
			$q=mysqli_query($db,"SELECT * FROM student where Username='$_SESSION[login_user]' ;");
		?>
		<h2 style="text-align: center;">My Profile</h2>
		<?php
			$row=mysqli_fetch_assoc($q);
			echo "<div style='text-align: center'><img class='img-circle profile-img' src='images/".$_SESSION['pic']."'></div>";
		?>
		<div style="text-align: center;"><b>Welcome</b>
		<h4>
			<?php
				echo $_SESSION['login_user']; 
			?>
		</h4>
		</div>
		<?php
		echo "<b>";
			echo "<table class='table table-bordered'>";
			echo "<tr>";
			echo "<td>"; echo "<b> Roll No: </b>"; echo "</td>";
			echo "<td>";  echo $row['roll']; echo "</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td>"; echo "<b> First Name: </b>"; echo "</td>";
			echo "<td>";  echo $row['first']; echo "</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td>";  echo "<b> Last Name: </b>"; echo "</td>";
			echo "<td>";  echo $row['last'];  echo "</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td>";  echo "<b> Username: </b>";echo "</td>";
			echo "<td>";  echo $row['Username'];  echo "</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td>";  echo "<b> Password: </b>"; echo "</td>";
			echo "<td>";  echo $row['password'];  echo "</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td>";  echo "<b> Contact No: </b>"; echo "</td>";
			echo "<td>";  echo $row['phone'];  echo "</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td>";  echo "<b> E-mail: </b>"; echo "</td>";
			echo "<td>";  echo $row['email'];  echo "</td>";
			echo "</tr>";

			echo "</table>";
			echo "</b>";
		?>
	</div>
	</div>

</body>
</html>