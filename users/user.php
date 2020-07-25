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

 global $conn;
 $query="SELECT id FROM user_info WHERE username='".$_SESSION['username']."'";
	if ($result = mysqli_query($conn,$query)){
		$row = mysqli_fetch_assoc($result);
		  $_SESSION['id'] = $row['id'];
		  $cookie_name = 'id';
		  $cookie_value = $_SESSION['id'];
  		  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); 
}

if(isset($_GET['logout'])){
	if ($_GET['logout']=='true') {
		$q = "UPDATE user_info SET status='Inactive' WHERE username = '".$_SESSION['username']."'";
		
					if ($conn->query($q) === TRUE) {
						 $_SESSION['logged_in'] = false;
						 $_SESSION['username']='';
						 $_SESSION['password']='';
						 $_SESSION['email']='';
						 setcookie("id", "", time() - 3600);
					} else {
					 echo "<script type='text/javascript'>Couldn't Log Out.</script> ";
					}
	}
}

if(isset($_POST['title'])&&isset($_POST['textarea'])&&isset($_POST['date'])&&isset($_POST['time'])){
	 $title = $_POST['title'];
	 $textarea = $_POST['textarea'];
	 $original_date = $_POST['date'];
	 $time = $_POST['time'];
	 $timestamp = strtotime($original_date);
 
	// Creating new date format from that timestamp
	$date = date("Y-m-d", $timestamp);

	//Insert data into Database-
	$sql = "INSERT INTO lists (id, title, description, date, time) VALUES ('".$_SESSION['id']."', '$title', '$textarea', '$date', '$time')";
	if ($conn->query($sql) === TRUE) {
		echo "success";
	} else {
		echo "error";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create List</title>
</head>
 <link rel="stylesheet" href="stylesheet/user.css">
 <link rel="stylesheet" href="stylesheet/stylelist.css">
<body>
    <div class="top-div">
		<?php include('header.php'); ?>
		   <div class="main">
               <input class="un " id="title" type="text" align="center" placeholder="Title" maxlength="20" minlength="1">
               <textarea class="un" id="textarea" rows="9" placeholder="Description" maxlength="300" minlength="1"></textarea>
            <div>
            <input class="date " id="date" type="date" align="center" value="" >
            <input class="date " id="time" type="time" align="center" value="">
		  </div>
			  <a class="save">Save</a>
			  <a class="cancel">Cancel</a>
		   </div>

		<div class="add_note">
			<button id="new" style="cursor:pointer;"><img class="plus" src="images/addNote.png" height="100px"></button>
			<h4 style="font-family: Arial, Helvetica, sans-serif; font-size:25px;">New</h4>
		</div>			
		</div>
	    
    </div>
   	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/users.js"></script>

</body>
</html>
<?php include('../footer.php'); ?>