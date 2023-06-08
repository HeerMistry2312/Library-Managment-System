<?php

	include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		Admin_Approval
	</title>
	<style type="text/css">
		
		body {
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
	</style>
</head>
<body>
	<!--- Side Navbar --->
	<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div style="color: white; margin-left: 100px;">

		<?php
		if (isset($_SESSION['login_user'])) {
			echo "<img class='img-circle profile_img' height=150 width=150 src='images/".$_SESSION['pic']."'>";
			echo "</br>";
			echo "<h4>";
			echo "Welcome ".$_SESSION['login_user'];
			echo "</h4>";
		}
		?>
</div>
  <div class="h"><a href="profile.php">PROFILE</a></div>
  <div class="h"><a href="books.php">BOOKS</a></div>
  <div class="h"><a href="request.php">BOOK REQUEST</a></div>
  <div class="h"><a href="issue_info.php">ISSUE INFORMATION</a></div>
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
	<!--- Search bar--->
	<div>
		<h2 style="float: left;">Search one Username at a time to approve the request</h2>
	<div style="float: right;" class="srch">
		<form class="navbar-form" method="post" name="form1">
				<input class="form-control" type="text" name="search" placeholder="Search Student Username..." required="">
				<button style="background-color: #6cc2bf;" type="submit" name="submit" class="btn btn-default">
					<span class="glyphicon glyphicon-search"></span>
				</button>
			
		</form>
	</div></div><br><br><br>
	<h2>New Requests</h2>
	<?php
		if(isset($_POST['submit']))
		{
			$q=mysqli_query($db,"SELECT id, first, last, Username, phone, email FROM `admin` where Username like '%$_POST[search]%' and status='' ");
			if(mysqli_num_rows($q)==0)
			{
				echo "Sorry! No New Request found with that Username. Try Searching again...";
			}
			else
			{
				echo "<table class='table table-bordered table-hover'>";
			echo "<tr style='background-color: #6cc2bf;'>";
			echo "<th>"; echo "ID";  echo "</th>";
			echo "<th>"; echo "First Name";  echo "</th>";
			echo "<th>"; echo "Last Name";  echo "</th>";
			echo "<th>"; echo "Username";  echo "</th>";
			echo "<th>"; echo "Contact No";  echo "</th>";
			echo "<th>"; echo "E-mail";  echo "</th>";
			
			echo "</tr>";
		while($row=mysqli_fetch_assoc($q))
		{
			$_SESSION['test_name']=$row['Username'];
			echo "<tr>";
			echo "<td>"; echo $row['id']; echo "</td>";
			echo "<td>"; echo $row['first']; echo "</td>";
			echo "<td>"; echo $row['last']; echo "</td>";
			echo "<td>"; echo $row['Username']; echo "</td>";
			echo "<td>"; echo $row['phone']; echo "</td>";
			echo "<td>"; echo $row['email']; echo "</td>";
			
			echo "</tr>";
		}
		echo "</table>";
		?>
		<form action="" method="post">
			<button type="submit" name="submit1" style="background-color: black; color: red; font-size: 18px; font-weight: 700;" class="btn btn-default"><span style="color: red;" class="glyphicon glyphicon-remove-sign"></span>&nbsp Remove</button>
			
			<button type="submit" name="submit2" style="background-color: black; color: green; font-size: 18px; font-weight: 700;" class="btn btn-default"><span style="color: green;" class="glyphicon glyphicon-ok-sign"></span>&nbsp Approve</button>
		</form>
		<?Php

			}
		}
		/*if button is not pressed*/
		else
		{
			$res=mysqli_query($db,"SELECT id, first, last, Username, phone, email FROM `admin` where status='';");
	echo "<table class='table table-bordered table-hover'>";
		echo "<tr style='background-color: #6cc2bf;'>";
			echo "<th>"; echo "ID";  echo "</th>";
			echo "<th>"; echo "First Name";  echo "</th>";
			echo "<th>"; echo "Last Name";  echo "</th>";
			echo "<th>"; echo "Username";  echo "</th>";
			echo "<th>"; echo "Contact No";  echo "</th>";
			echo "<th>"; echo "E-mail";  echo "</th>";
		echo "</tr>";
		while($row=mysqli_fetch_assoc($res))
		{
			echo "<tr>";
			echo "<td>"; echo $row['id']; echo "</td>";
			echo "<td>"; echo $row['first']; echo "</td>";
			echo "<td>"; echo $row['last']; echo "</td>";
			echo "<td>"; echo $row['Username']; echo "</td>";
			echo "<td>"; echo $row['phone']; echo "</td>";
			echo "<td>"; echo $row['email']; echo "</td>";
			echo "</tr>";
		}
		echo "</table>";

		}
		if (isset($_POST['submit1'])) {
			mysqli_query($db,"DELETE from admin where Username='$_SESSION[test_name]' and status='';");
			unset($_SESSION['test_name']);
		}
		if (isset($_POST['submit2'])) {
			mysqli_query($db,"UPDATE admin set status='Yes' where Username='$_SESSION[test_name]';");
			unset($_SESSION['test_name']);
		}

	?>
</div>
</body>
</html>