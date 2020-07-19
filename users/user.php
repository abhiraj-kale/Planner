<?php 
require '../connect.inc.php';
ob_start();
session_start();
$_SESSION['username'];
$_SESSION['password']; 
$_SESSION['email'];
$_SESSION['logged_in'];
if($_SESSION['logged_in']==false){
    header('Location: ../log_in.php');
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create List</title>
</head>
 <link rel="stylesheet" href="stylesheet/user.css">
<body>
    <div class="top-div">
        <div id="topnav" class="topnav">
		   <a href="../index.php"><button>Planner</button><label>.in</label></a>
		   <div class="tab">
		   <a href="createlist.html">Create List</a>
		   <a href="#news">My List</a>
		   </div>
				<div class="top_menu">
					<a href="#" class="menu">
						<div class="one"></div>
						<div class="two"></div>
						<div class="three"></div>
					<ul class="drop_down">
						<li>Profile</li>
						<li>Settings</li>
						<li>Log Out</li>
					</ul>
				 </a>
		        </div>
   	    </div>

		<div class="add_note">
			<button><img class="plus" src="images/addNote.png" height="100px"></button>
			<h4 style="font-family: Arial, Helvetica, sans-serif; font-size:25px;" >New</h4>
			</div>
		</div>
	    
    </div>
    <div class="bottom-div">
        <footer class="footer-distributed">

			<div class="footer-left">

				<h3>Planner<span>.in</span></h3>

				<p class="footer-links">
					<a href="../index.php">Home</a>
					·
					<a href="#">Blog</a>
					·
					<a href="../about.php">About</a>
				</p>

				<p class="footer-company-name">Planner © 2020</p>


			</div>

			<div class="footer-right">

				<p>Contact Us</p>

				<form action="#" method="post">

					<input type="text" name="email" placeholder="Email">
					<textarea name="message" placeholder="Message"></textarea>
					<button>Send</button>

				</form>

			</div>

		</footer>
	</div>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/user.js"></script>
</body>
</html>
