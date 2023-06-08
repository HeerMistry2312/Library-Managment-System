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
		Book Request
	</title>
	<style type="text/css">
		.srch{
			padding-left: 1155px;
		}
		.form-control{
			width: 350px;
			height: 30px;

		}

		body {
background-image: url("images/up.jpg");
  font-family: "Lato", sans-serif;
  transition: background-color .5s;
}

.sidenav {
  height: 100%;
  margin-top: 50px;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #222;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}
.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}
.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

#main {
  transition: margin-left .5s;
  padding: 16px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.h:hover{
		color: white;
		width: 350px;
		height: 50px;
		background-color: #00544c;
		opacity: .5;
	}
	.Approve{
		margin-left: 390px;
	}
	</style>
</head>
<body>
	<!--- Side Navbar--->
	<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div style="color: white; margin-left: 100px;">
<?php

		if (isset($_SESSION['login_user'])){
			echo "<img class='img-circle profile_img' height=150 width=150 src='images/".$_SESSION['pic']."'>";
			echo "</br>";
			echo "<h4>";
			echo "Welcome ".$_SESSION['login_user'];
			echo "</h4>";
		}
		?>
</div>
  <div class="h"><a href="add.php">ADD BOOKS</a></div>
  <div class="h"><a href="request.php">BOOK REQUEST</a></div>
  <div class="h"><a href="issue_info.php">ISSUE INFORMATION</a>
</div>
<div class="h"><a href="expired.php">EXPIRED LIST</a></div>
</div>

<div id="main">
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>


<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "350px";
  document.getElementById("main").style.marginLeft = "350px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "white";
}
</script>
<div class="container" style="margin-top: 50px;">
	<br><h2 style="color: black; font-family: Lucida Console; text-align: center;"><b>Approve Request</b></h2><br>
	<form class="Approve" action="" method="post">
		
		<input type="text" name="approve" class="form-control" placeholder="Yes OR No" required=""><br>

		<input type="text" name="issue" class="form-control" placeholder="Issue Date (yyyy-mm-dd)" required=""><br>

		<input type="text" name="return" class="form-control" placeholder="Return Date (yyyy-mm-dd)" required=""><br>

		<input type="text" name="tm" class="form-control" placeholder="Return Date   Jun 05, 2023 14:40:00" required="">

		<button class="btn btn-default" type="submit" name="submit">APPROVE</button>

	</form>
</div>
</div>
<?php
	if(isset($_POST['submit'])){
		mysqli_query($db,"INSERT into timer VALUES('$_SESSION[name]', '$_SESSION[bid]', '$_POST[tm]');");


		mysqli_query($db,"UPDATE `issue_book` SET `approve` = '$_POST[approve]', `issue` = '$_POST[issue]', `return` = '$_POST[return]' WHERE Username='$_SESSION[name]' and bid='$_SESSION[bid]';");

		mysqli_query($db,"UPDATE books SET quantity = quantity-1 where bid='$_SESSION[bid]';");

		mysqli_query($db,"UPDATE books SET bcount = bcount+1 where bid='$_SESSION[bid]';");

		$res=mysqli_query($db,"SELECT quantity from books where bid='$_SESSION[bid]';");

		while($row=mysqli_fetch_assoc($res)) {
			if($row['quantity']==0) {
				mysqli_query($db,"UPDATE books SET status='not-available' where bid='$_SESSION[bid]';");
			}
		}
		?>
		<script type="text/javascript">
			alert("Updated Successfully...");
			window.location="request.php"
		</script>
		<?php
	}

?>
</body>
</html>

