<?php
require "connect.inc.php";
ob_start();
session_start();

$_SESSION['username'];
$_SESSION['password'];
$_SESSION['email'];
$_SESSION['logged_in'] = false;
$_SESSION['account_not_exist'] = false;
$_SESSION['invalid_password'] = false;

if (isset($_POST['username']) && isset($_POST['password'])) {
	if (!empty($_POST['username']) && !empty($_POST['password']) ){
		global $conn;
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = md5(mysqli_real_escape_string($conn,$_POST['password']));
	$email = mysqli_real_escape_string($conn,$_POST['username']);
	
	// Retrieving data from the databsee
	 $query="SELECT id,username,email,password FROM user_info WHERE username='$username' OR email='$email'";
	//Checking if account exists
		if ($result = mysqli_query($conn,$query)) {
			if(mysqli_num_rows($result)==0){
				$_SESSION['account_not_exist'] = true;
			}else if (mysqli_num_rows($result)==1) {
				 $row = mysqli_fetch_assoc($result);
				 if ($password == $row['password']) {

					$query="SELECT id FROM user_info WHERE username='".$_SESSION['username']."'";

						if ($r = mysqli_query($conn,$query)){
							$row = mysqli_fetch_assoc($r);
							  $_SESSION['id'] = $row['id'];
						}

					$q = "UPDATE user_info SET status='Active' WHERE username = '$username'";

					if ($conn->query($q) === TRUE) {
						 $_SESSION['logged_in'] = true;
						 $_SESSION['username']=$username;
						 header('Location: ./users/user.php');
					} else {
					 echo "<script type='text/javascript'>Couldn't Log In</script> ";
					}

				 }else {
					$_SESSION['invalid_password'] = true;
				 }
			}
		}
	}
}

?>
<html>
<head>
  <link rel="stylesheet" href="stylesheet/index.css">
  <link rel="stylesheet" href="stylesheet/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Log in</title>
</head>
<body>
  <div class="top-div">
  <?php include("header.php")?>
         <div class="main">
		   <p class="sign" align="center">Log in</p>
		   <label for=""><?php if($_SESSION['account_not_exist']){echo "Account doesn't exist";}elseif($_SESSION['invalid_password']){echo "Invalid password";} ?></label> 
           <form class="form1" action="log_in.php" method="POST">
             <input class="un " name="username" type="text" align="center" placeholder="Enter username/Email">
             <input class="pass" name="password" type="password" align="center" placeholder="Enter password">
             <input type="submit" class="submit" align="center" value="Log in!">
             <p class="forgot" align="center"><a href="#">Forgot Password?</a></p>
			</form>

           </div>
       </div>
	   <?php include("footer.php")?>
</body>
</html>