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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		.srch{
			padding-left: 1200px;
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
	.book{
		width: 500px;
		margin: 0px auto ;
	}
	.form-control
	{
		height: 35px;
	}
	
	

	</style>
</head>
<body>
	<!--- Side Navbar --->
	<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  	<div style="color: white; margin-left: 100px;">

		<?php
		if(isset($_SESSION['login_user'])){
			echo "<img class='img-circle profile_img' height=150 width=150 src='images/".$_SESSION['pic']."'>";
			echo "</br>";
			echo "<h4>";
			echo "Welcome ".$_SESSION['login_user'];
			echo "</h4>";
		}
		?>
	</div>
  <div class="h"><a href="add.php">ADD BOOKS</a></div>
  <div class="h"><a href="books.php">DELETE BOOKS</a></div>
  <div class="h"><a href="request.php">BOOK REQUEST</a></div>
  <div class="h"><a href="#">ISSUE INFORMATION</a></div>
  <div class="h"><a href="expired.php">EXPIRED LIST</a></div>
</div>

<div id="main">
  
  <span style="font-size:30px;cursor:pointer; color: black;" onclick="openNav()">&#9776; open</span>
  <div class="container"  style="text-align: center; ">
  	<h2 style="color: black; font-family: Lucida Console; text-align: center;"><b>Add New Books</b></h2>
  	<form class="book" action="" method="post">
  		<input type="text" name="bid" class="form-control" placeholder="Book ID" required=""><br>
  		<input type="text" name="name" class="form-control" placeholder="Book Name" required=""><br>
  		<input type="text" name="authors" class="form-control" placeholder="Authors" required=""><br>
  		<input type="text" name="edition" class="form-control" placeholder="Edition" required=""><br>
  		<input type="text" name="status" class="form-control" placeholder="Status" required=""><br>
  		<input type="text" name="quantity" class="form-control" placeholder="Quantity" required=""><br>
  		<input type="text" name="department" class="form-control" placeholder="Department" required=""><br>
  		<button class="btn btn-default" type="submit" name="submit">ADD</button>

  	</form>
  </div>
<?php
	if (isset($_POST['submit'])) {
		if (isset($_SESSION['login_user'])){
			mysqli_query($db,"INSERT INTO books VALUES ('$_POST[bid]', '$_POST[name]', '$_POST[authors]', '$_POST[edition]', '$_POST[status]', '$_POST[quantity]','$_POST[department]','0') ;");
?>
	<script type="text/javascript">
		alert("Book Added Successfully...");
	</script>

<?php
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
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "350px";
  document.getElementById("main").style.marginLeft = "350px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "#6cc2bf";
}
</script>
  

</body>
</html>