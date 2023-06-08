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
		Expired List
	</title>
	<style type="text/css">
		.srch{
			padding-left: 970px;
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
  padding-left: 16px;
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
	.container
	{
		margin-top: -50px;
		
	}
	.scroll{
		width: 100%;
		height: 400px;
		overflow: auto;
	}
	th,td{
		width: 10%;
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

	<?php
		if(isset($_SESSION['login_user']))
		{
	?>
	<div style="float: left; padding: 25px;">
		<form action="" method="post">
			<button name="submit2" type="submit" class="btn btn-default" style="background-color: #6cc2bf;">RETURN</button> &nbsp&nbsp
			<button name="submit3" type="submit" class="btn btn-default" style="background-color: #6cc2bf;">EXPIRED</button>
		</form>
	</div>
	<div style="float: right;padding-top: 60px;">
		<?php
		$var=0;
			$result=mysqli_query($db,"SELECT * FROM `fine` where Username='$_SESSION[login_user]' and  status='not paid';");

			while($r=mysqli_fetch_assoc($result))
			{
				$var=$var+$r['fine'];
			}
			$var2=$var+$_SESSION['fine'];

		?>
		<h3>Your Fine is:
			<?php
				echo "₹".$var2;
			?>
		</h3>
		
	</div><br><br>
	
	<h2 style="text-align: center; padding-right: 200px;">Date Expired List</h2><br>
	<?php
		

		$ret='<p style="background-color:green; color:yellow;">RETURNED</p>';
		$exp='<p style="background-color:red; color:yellow;">EXPIRED</p>';
		
			if(isset($_POST['submit2']))
			{
				$sql="SELECT student.Username, roll, books.bid, name, authors, edition,approve, issue_book.issue, issue_book.return FROM student INNER JOIN issue_book ON STUDENT.Username = issue_book.Username INNER JOIN books ON issue_book.bid = books.bid WHERE issue_book.approve = '$ret' and issue_book.Username='$_SESSION[login_user]' ORDER BY `issue_book`.`return` DESC";

				$res=mysqli_query($db,$sql);
			}
			else if(isset($_POST['submit3']))
			{
				$sql="SELECT student.Username, roll, books.bid, name, authors, edition,approve, issue_book.issue, issue_book.return FROM student INNER JOIN issue_book ON STUDENT.Username = issue_book.Username INNER JOIN books ON issue_book.bid = books.bid WHERE issue_book.approve = '$exp' and issue_book.Username='$_SESSION[login_user]' ORDER BY `issue_book`.`return` DESC";

				$res=mysqli_query($db,$sql);
			}
			else
			{
				$sql="SELECT student.Username, roll, books.bid, name, authors, edition,approve, issue_book.issue, issue_book.return FROM student INNER JOIN issue_book ON STUDENT.Username = issue_book.Username INNER JOIN books ON issue_book.bid = books.bid WHERE issue_book.approve != '' and issue_book.approve != 'Yes' and issue_book.Username='$_SESSION[login_user]' ORDER BY `issue_book`.`return` DESC";

				$res=mysqli_query($db,$sql);
			}

			echo "<table class='table table-bordered table-hover'>";
			echo "<tr style='background-color: #6cc2bf;'>";
			echo "<th>"; echo "Roll No";  echo "</th>";
			echo "<th>"; echo "Username";  echo "</th>";
			echo "<th>"; echo "Book ID";  echo "</th>";
			echo "<th>"; echo "Book Name";  echo "</th>";
			echo "<th>"; echo "Author Name";  echo "</th>";
			echo "<th>"; echo "Edition";  echo "</th>";
			echo "<th>"; echo "Status";  echo "</th>";
			echo "<th>"; echo "Issue Date";  echo "</th>";
			echo "<th>"; echo "Return Date";  echo "</th>";
			echo "</tr>";
			echo "</table>";

			echo "<div class='scroll'>";
			echo "<table class='table table-bordered table-hover' style='width: 100%;'>";
		while($row=mysqli_fetch_assoc($res))
		{
			/*$d=date("Y-m-d");
			if($d > $row['return'])
			{
				$c=$c+1;
				$var='<p style="background-color:red; color:yellow;">EXPIRED</p>';
				mysqli_query($db,"UPDATE issue_book SET approve='$var' where `return`='$row[return]' and approve='Yes' limit $c;");

				echo $d."</br>";
			}*/
			
			echo "<tr>";
			echo "<td>"; echo $row['roll']; echo "</td>";
			echo "<td>"; echo $row['Username']; echo "</td>";
			echo "<td>"; echo $row['bid']; echo "</td>";
			echo "<td>"; echo $row['name']; echo "</td>";
			echo "<td>"; echo $row['authors']; echo "</td>";
			echo "<td>"; echo $row['edition']; echo "</td>";
			echo "<td>"; echo $row['approve']; echo "</td>";
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