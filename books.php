<?php
	include "connection.php";
	include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Books</title>
	<style type="text/css">
		.srch{
			
			padding-left: 1155px;
		}
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
	<?php
		$b=mysqli_query($db,"SELECT * FROM `books` order by bcount desc limit 0,3;");

	?>
	<div style="width: 100%; height: 50px; margin-top: -20px;">
		<div style="background-color: #F44336; padding: 10px;
		width: 10%; height: 50px; float: left;">
			<h3 style="color: white; margin-top: 0px;">Trending:</h3>
		</div>
		<div style="background-color: #ffcccc; width: 90%; height: 50px; float: left; padding: 10px;">
			<table>
				<?php
				while($b2=mysqli_fetch_assoc($b))
				{
					echo "<tr style='color: black; width: 400px; margin-top: 0px; float: left;'>";
					echo "<td>"; echo "[".$b2['bid']."] &nbsp&nbsp"; echo "</td>";
					echo "<td>"; echo $b2['name']; echo "</td>";
					echo "</tr>";
				}
				?>
				
			</table>
			
		</div>
	</div>
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
  <div class="h"><a href="profile.php">PROFILE</a></div>
  <div class="h"><a href="books.php">BOOKS</a></div>
  <div class="h"><a href="request.php">BOOK REQUEST</a></div>
  <div class="h"><a href="issue_info.php">ISSUE INFORMATION</a></div>
    <div class="h"><a href="expired.php">EXPIRED INFORMATION</a></div>
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
	<div class="srch">
		<form class="navbar-form" method="post" name="form1">
			<label for="department">Choose a Department: </label>
			<select name="department">
				<optgroup label="Educational">
					<option>Computer Science</option>
					<option>IT</option>
				</optgroup>
				<optgroup label="Entertainment">
					<option>Science Fiction</option>
					<option>Love Story</option>
					<option>Novel</option>
				</optgroup>
			</select>
				<input class="form-control" type="text" name="search" placeholder="Search Books..." required="">
				<button style="background-color: #6cc2bf;" type="submit" name="submit" class="btn btn-default">
					<span class="glyphicon glyphicon-search"></span>
				</button>
			
		</form>
	</div>

	<!--Request book-->
	<div class="srch">
		<form class="navbar-form" method="post" name="form1">
				<input class="form-control" type="text" name="bid" placeholder="Enter Book ID" required="">
				<button style="background-color: #6cc2bf;" type="submit" name="submit1" class="btn btn-default">Request
				</button>
			
		</form>
	</div>
	<h2>List Of Books</h2>
	<?php
		if(isset($_POST['submit']))
		{

			$q=mysqli_query($db,"SELECT * FROM books where name like '%$_POST[search]%' and department='$_POST[department]';");
			if(mysqli_num_rows($q)==0)
			{
				echo "Sorry! No Books found. Try Searching again...";
			}
			else
			{
				echo "<table class='table table-bordered table-hover'>";
			echo "<tr style='background-color: #6cc2bf;'>";
			echo "<th>"; echo "ID";  echo "</th>";
			echo "<th>"; echo "Book-Name";  echo "</th>";
			echo "<th>"; echo "Authors Name";  echo "</th>";
			echo "<th>"; echo "Edition";  echo "</th>";
			echo "<th>"; echo "Status";  echo "</th>";
			echo "<th>"; echo "Quantity";  echo "</th>";
			echo "<th>"; echo "Department";  echo "</th>";
			echo "</tr>";
		while($row=mysqli_fetch_assoc($q))
		{
			echo "<tr>";
			echo "<td>"; echo $row['bid']; echo "</td>";
			echo "<td>"; echo $row['name']; echo "</td>";
			echo "<td>"; echo $row['authors']; echo "</td>";
			echo "<td>"; echo $row['edition']; echo "</td>";
			echo "<td>"; echo $row['status']; echo "</td>";
			echo "<td>"; echo $row['quantity']; echo "</td>";
			echo "<td>"; echo $row['department']; echo "</td>";
			echo "</tr>";
		}
		echo "</table>";
			}
		}
		/*if button is not pressed*/
		else
		{
			$res=mysqli_query($db,"SELECT * FROM `books` ;");
	echo "<table class='table table-bordered table-hover'>";
		echo "<tr style='background-color: #6cc2bf;'>";
			echo "<th>"; echo "ID";  echo "</th>";
			echo "<th>"; echo "Book-Name";  echo "</th>";
			echo "<th>"; echo "Authors Name";  echo "</th>";
			echo "<th>"; echo "Edition";  echo "</th>";
			echo "<th>"; echo "Status";  echo "</th>";
			echo "<th>"; echo "Quantity";  echo "</th>";
			echo "<th>"; echo "Department";  echo "</th>";
		echo "</tr>";
		while($row=mysqli_fetch_assoc($res))
		{
			echo "<tr>";
			echo "<td>"; echo $row['bid']; echo "</td>";
			echo "<td>"; echo $row['name']; echo "</td>";
			echo "<td>"; echo $row['authors']; echo "</td>";
			echo "<td>"; echo $row['edition']; echo "</td>";
			echo "<td>"; echo $row['status']; echo "</td>";
			echo "<td>"; echo $row['quantity']; echo "</td>";
			echo "<td>"; echo $row['department']; echo "</td>";
			echo "</tr>";
		}
		echo "</table>";

		}
		if(isset($_POST['submit1']))
		{
			if(isset($_SESSION['login_user']))
			{
				$sql1=mysqli_query($db,"SELECT * FROm `books` where bid='$_POST[bid]';");
				$row1=mysqli_fetch_assoc($sql1);
				$count1=mysqli_num_rows($sql1);

				if($count1 != 0)
				{
					mysqli_query($db,"INSERT INTO issue_book VALUES('$_SESSION[login_user]', '$_POST[bid]', '', '', '');");
				?>
				<script type="text/javascript">
					window.location="request.php"
				</script>
				<?php
				}
				else
				{
					?>
				<script type="text/javascript">
					alert("The book is not available...");
				</script>
				<?php
				}
			}
			else
			{
				?>
				<script type="text/javascript">
					alert("You Need to Login First...");
				</script>
				<?php
			}
		}

	?>
	</div>
</body>
</html>