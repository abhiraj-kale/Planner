<?php 
require '../connect.inc.php';
ob_start();
session_start();
 $_SESSION['username'];
 $_SESSION['password'];
 $_SESSION['email'];
 $_SESSION['id'];
 $_SESSION['logged_in'];
if($_SESSION['logged_in']==false){
    header('Location: ../log_in.php');
};

global $conn;
$query="SELECT id FROM user_info WHERE username='".$_SESSION['username']."'";
   if ($result = mysqli_query($conn,$query)){
       $row = mysqli_fetch_assoc($result);
		 $_SESSION['id'] = $row['id'];
		 $cookie_name = 'id';
		  $cookie_value = $_SESSION['id'];
  		  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Lists</title>
</head>
<link rel="stylesheet" href="stylesheet/user.css">
   <link rel="stylesheet" href="stylesheet/stylelist.css">
<body>
    <div class="top-div">
	<?php include('header.php'); ?>
	<?php include('showlists.php'); ?>
    </div>
    <div class="bottom-div">
        <footer class="footer-distributed">

			<div class="footer-left">

				<h3>Planner<span>.in</span></h3>

				<p class="footer-links">
					<a href="#">Home</a>
					·
					<a href="#">Blog</a>
					·
					<a href="#">About</a>
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
</body>
</html>