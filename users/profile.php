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
}
?>