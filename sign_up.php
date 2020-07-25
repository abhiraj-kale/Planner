<?php 
require 'connect.inc.php';
ob_start();
session_start();

$_SESSION['username'];
$_SESSION['password'];
$_SESSION['email'];
$_SESSION['logged_in'] = false;
$_SESSION['account_exists'] = false;

if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['email'])){
	if (!empty($_POST['username'])&&!empty($_POST['password'])&&!empty($_POST['email'])){
		global $conn;
		$username = mysqli_real_escape_string($conn,$_POST['username']);
		$email = mysqli_real_escape_string($conn,$_POST['email']);
		$password =  md5(mysqli_real_escape_string($conn,$_POST['password']));

		$query="SELECT id,username,email,password FROM user_info WHERE email='$email'";
		if ($result = mysqli_query($conn,$query)) {
			if(mysqli_num_rows($result)>=1){
				$_SESSION['account_exists'] = true;
			}else{
					//Insert into table
					$_SESSION['account_exists'] = false;	
					
					
					$sql = "INSERT INTO user_info (username, password,email) VALUES ('$username', '$password', '$email')";
	
					if ($conn->query($sql) === TRUE) {
						$query="SELECT id FROM user_info WHERE username='".$_SESSION['username']."'";
						if ($result = mysqli_query($conn,$query)){
							$row = mysqli_fetch_assoc($result);
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
					} else {
					header('Location: sign_up.php');
					}
	
					$conn->close();
				
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

  <title>Sign up</title>
</head>

<body>
	
  <div class="top-div">
  <?php include("header.php")?>

         <div class="main">
	
		 <h3 class="sign" align="center">Sign up in seconds</h3>
		 <label for=""><?php if($_SESSION['account_exists']){echo "Account exists";} ?></label>   
	<form class="form1" action="sign_up.php" method="POST"> 
			 <input class="un " name="username" type="text" align="center" placeholder=" What's your username?" minlength="6" required>
			 <input type="email" name="email" class="email" id="email" placeholder="Enter your E-Mail" required>
             <input class="pass" name ="password" type="password" align="center" placeholder="Choose a password" minlength="8" required>
             <input type="submit" class="submit" align="center" value="Sign Up!"></input>
              <p class="forgot" align="center">Have an account? <input type="button" name="login" value="Log in" onclick="window.location.href='log_in.php'"></input></p>
			</form>
         </div>
 </div>

 		   <script src="js/jquery.js"></script>

	<?php include("footer.php")?>

		   
</body>

</html>
