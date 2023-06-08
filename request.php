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
	th,td,input{
		width: 100px;
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
<?php
/*if(isset($_SESSION['login_user']))
		{*/
			$q=mysqli_query($db,"SELECT * FROM issue_book where Username='$_SESSION[login_user]' and approve='';");

			if(mysqli_num_rows($q)==0)
			{
				echo "</br></br></br>";
				echo "<h2><b>";
				echo "There's No Pending Request...";
				echo "</h2></b>";
			}
			else
			{
				?>
				<form method="post">

				<?php
				echo "<table class='table table-bordered table-hover'>";
			echo "<tr style='background-color: #6cc2bf;'>";
			echo "<th>"; echo "Select";  echo "</th>";
			echo "<th>"; echo "BOOK_ID";  echo "</th>";
			echo "<th>"; echo "APPROVE _STATUS";  echo "</th>";
			echo "<th>"; echo "ISSUE_DATE";  echo "</th>";
			echo "<th>"; echo "RETURN_DATE";  echo "</th>";
			echo "</tr>";
		while($row=mysqli_fetch_assoc($q))
		{
			echo "<tr>"; ?>
			<td><input type="checkbox" name="check[]" value="<?php echo $row["bid"] ?>"></td>

			<?php
			echo "<td>"; echo $row['bid']; echo "</td>";
			echo "<td>"; echo $row['approve']; echo "</td>";
			echo "<td>"; echo $row['issue']; echo "</td>";
			echo "<td>"; echo $row['return']; echo "</td>";
			echo "</tr>";
		}
		echo "</table>";
		?>
		<p align="center"><button type="submit" name="delete" class="btn btn-success" onclick="location.reload()">DELETE</button></p>
		<?php
			}
			if (isset($_POST['delete'])) {
				if (isset($_POST['check'])) {
					foreach ($_POST['check'] as $delete_id) {
						mysqli_query($db,"DELETE from issue_book WHERE bid='$delete_id' and Username='$_SESSION[login_user]' ORDER BY bid ASC LIMIT 1;");
					}
				}
			}
		/*}
		else
		{
			echo "</br></br></br>";
			echo "<h2><b>";
			echo " Please Login First To See The Infornmation...";
			echo "</h2></b>";
		}*/
?>
		

	
</body>
</html>