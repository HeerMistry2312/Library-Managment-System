<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Online Library Managment System
	</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewpot" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
	nav
	{
	    float: right;
	    word-spacing: 30px;
	    padding: 20px;
	}
	nav li
	{
	    display: inline-block;
	    line-height: 80px;
	}
	section .sec_img
{
    background-image: url("images/202.png");
    height: 513px;
    width: 1536px;
    margin-top: 0px;
    background-repeat: no-repeat;
}
	.fa{
		
		padding: 5px;
		font-size: 20px;
		width: 20px;
		height: 20px;
		text-align: center;
		text-decoration: none;
		border-radius: 50%;
	}
	.fa:hover{
		opacity: .7;
	}
	.fa-facebook{
		background: #3B5998;
		color: white;
	}
	.fa-instagram{
		background: hotpink;
		color: white;
	}
	.fa-yahoo{
		background: #400297;
		color: white;
	}
	.fa-github{
		background: blck;
		color: white;
	}
	.fa-linkedin{
		background: blue;
		color: white;
	}
	.fa-twitter{
		background: #55acee;
		color: white;
	}
	.fa-google{
		background: #dd4b39;
		color: white;
	}

</style>
</head>

<body>
	<div class="wrapper">
		<header>
			<div class="logo">
			 	<img src="images/4.png">
			 	<h1 style="color: white;">ONLINE LIBRARY MANAGMENT SYSTEM</h1>
			</div>
			<?php
			if(isset($_SESSION['login_user']))
			{
				?>
				<nav>
				<ul>
					<li><a href="../index.php">HOME</a></li>
					<li><a href="books.php">BOOKS</a></li>
					<li><a href="logout.php">LOGOUT</a></li>
					<li><a href="feedback.php">FEEDBACK</a></li>
				</ul>
			</nav>
			<?php
			}
			else
			{
			?>
			<nav>
				<ul>
					<li><a href="../index.php">HOME</a></li>
					<li><a href="books.php">BOOKS</a></li>
					<li><a href="../login.php">LOGIN</a></li>
					<li><a href="registration.php">REGISTRATION</a></li>
					<li><a href="feedback.php">FEEDBACK</a></li>
				</ul>
			</nav>
			<?php

			}
			?>
			
		</header>
		<section>
			<div class="sec_img">
			<br><br><br>
			<div class="box">
				<br><br><br><br>
				<h1 style="text-align: center; font-size: 40px;">Welcome to library</h1><br>
				<h1 style="text-align: center; font-size: 30px;">Opens at:09:00 </h1><br>
				<h1 style="text-align: center; font-size: 30px;">Closes at:16:00</h1><br>
			</div>
		</div>
		</section>
		<footer>

		<div style="margin: 0px 650px;">
			<br>
			<a href="#" class="fa fa-facebook"></a>
			<a href="#" class="fa fa-instagram"></a>
			<a href="#" class="fa fa-yahoo"></a>
			<a href="#" class="fa fa-github"></a>
			<a href="#" class="fa fa-linkedin"></a>
			<a href="#" class="fa fa-twitter"></a>
			<a href="#" class="fa fa-google"></a>
		</div>
		
			<p style="color: white;text-align: center;">
				
				Email:&nbsp online.library@gmail.com<br>
				Mobile:&nbsp +91 9998887771
			</p>
		</footer>
	</div>
</body>
</html>