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
		color: black;
		width: 350px;
		height: 50px;
		background-color: black;
		opacity: .5;
	}
	/*.container
	{
		height: 550px;
		background-color: black;
		opacity: .7;
		color: white;
	}*/
	.scroll{
		width: 100%;
		height: 500px;
		overflow: auto;
	}
	th,td{
		width: 12%;
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
  <div class="h"><a href="profile.php">PROFILE</a></div>
  <div class="h"><a href="books.php">BOOKS</a></div>
  <div class="h"><a href="request.php">BOOK REQUEST</a></div>
  <div class="h"><a href="issue_info.php">ISSUE INFORMATION</a></div>
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
<div class="container">
	<h2 style="text-align: center;">Information Of Borrowed Books</h2>
	<?php
	$c=0;

	if(isset($_SESSION['login_user']))
	{
		$sql="SELECT student.Username, roll, books.bid, name, authors, edition, issue_book.issue, issue_book.return FROM student INNER JOIN issue_book ON STUDENT.Username = issue_book.Username INNER JOIN books ON issue_book.bid = books.bid WHERE issue_book.approve = 'Yes' and issue_book.Username='$_SESSION[login_user]' ORDER BY `issue_book`.`return` ASC";

			$res=mysqli_query($db,$sql);
			
			echo "<table class='table table-bordered table-hover'>";
			echo "<tr style='background-color: #6cc2bf;'>";
			echo "<th>"; echo "Roll No";  echo "</th>";
			echo "<th>"; echo "Username";  echo "</th>";
			echo "<th>"; echo "Book ID";  echo "</th>";
			echo "<th>"; echo "Book Name";  echo "</th>";
			echo "<th>"; echo "Author Name";  echo "</th>";
			echo "<th>"; echo "Edition";  echo "</th>";
			echo "<th>"; echo "Issue Date";  echo "</th>";
			echo "<th>"; echo "Return Date";  echo "</th>";
			echo "</tr>";
			echo "</table>";

			echo "<div class='scroll'>";
			echo "<table class='table table-bordered table-hover' style='width: 100%;'>";
		while($row=mysqli_fetch_assoc($res))
		{
			$d=date("Y-m-d");
			if($d > $row['return'])
			{
				$c=$c+1;
				$var='<p style="background-color:red; color:yellow;">EXPIRED</p>';
				mysqli_query($db,"UPDATE issue_book SET approve='$var' where `return`='$row[return]' and approve='Yes' limit $c;");

				echo $d."</br>";
			}
			
			echo "<tr>";
			echo "<td>"; echo $row['roll']; echo "</td>";
			echo "<td>"; echo $row['Username']; echo "</td>";
			echo "<td>"; echo $row['bid']; echo "</td>";
			echo "<td>"; echo $row['name']; echo "</td>";
			echo "<td>"; echo $row['authors']; echo "</td>";
			echo "<td>"; echo $row['edition']; echo "</td>";
			echo "<td>"; echo $row['issue']; echo "</td>";
			echo "<td>"; echo $row['return']; echo "</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</div>";
		
	}
	else
	{
		?>
			<h2 style="text-align: center;">Login to See Information Of Borrowed Books</h2>
		<?php
	}

	?>
</div>
</div>
</body>
</html>