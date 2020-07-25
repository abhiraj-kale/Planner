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
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query="SELECT id,list_id,title,description,date,time,complete FROM lists WHERE list_id=$id";
        if ($result = mysqli_query($conn,$query)) {
                if (mysqli_num_rows($result)==1) {
                    $row = mysqli_fetch_assoc($result);
                    $data = ['title' =>$row['title'], 'description' => $row['description'], 'date'=>$row['date'], 'time'=>$row['time'] ];
                    echo json_encode($data);
                }
            
        }
    }
    if (isset($_GET['delete_list'])) {
        $id = $_GET['delete_list'];
        $q = "DELETE FROM lists WHERE list_id=$id";

					if ($conn->query($q) === TRUE) {
                        echo "success";
					} else {
                        echo "faliure";
					}
    }

    if (isset($_POST['list_id'])) {
        $id = $_POST['list_id'];
        $query="UPDATE lists SET complete=1 WHERE list_id=$id";
        if ($conn->query($query) === TRUE) {
            echo "success";
        } else {
            echo "failure";
        }
    }
    if (isset($_POST['change_id'])) {
        $id = $_POST['change_id'];
        $query="UPDATE lists SET complete=0 WHERE list_id=$id";
        if ($conn->query($query) === TRUE) {
            echo "success";
        } else {
            echo "failure";
        }
    }

    if(isset($_POST['listid'])&&isset($_POST['title'])&&isset($_POST['textarea'])&&isset($_POST['date'])&&isset($_POST['time'])){
        $id = $_POST['listid'];
        $title = $_POST['title'];
        $textarea = $_POST['textarea'];
        $original_date = $_POST['date'];
        $time = $_POST['time'];
        $timestamp = strtotime($original_date);
    
       // Creating new date format from that timestamp
       $date = date("Y-m-d", $timestamp);
   
       //Insert data into Database-
       $sql = "UPDATE lists SET title='$title', description='$textarea',date='$date',time='$time' WHERE list_id=$id";
       if ($conn->query($sql) === TRUE) {
           echo "success";
       } else {
           echo "error";
       }
   }
   if (isset($_POST['username'])) {
    $username = $_POST['username'];
     $id = $_SESSION['id'];
        $sql = "UPDATE user_info SET username='$username' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['username'] = $username;
            echo "success";
        } else {
            echo "error";
        }
   }

   if (isset($_POST['email'])) {
    $email = $_POST['email'];
     $id = $_SESSION['id'];
        $sql = "UPDATE user_info SET email='$email' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "success";
            $_SESSION['email'] = $email;
        } else {
            echo "error";
        }
   }

   if (isset($_POST['oldpass'])&& isset($_POST['newpass'])) {
  
   $oldpass = md5($_POST['oldpass']);
   $newpass = md5($_POST['newpass']);
   $id = $_SESSION['id'];
        $query="SELECT password FROM user_info WHERE id=$id";

        if ($result = mysqli_query($conn,$query)){
            $row = mysqli_fetch_assoc($result);
             if ( $oldpass==$row['password']) {
                $sql = "UPDATE user_info SET password='$newpass' WHERE id=$id";
                if ($conn->query($sql) === TRUE) {
                    echo "Password Changed";
                } else {
                    echo "Error";
                }
            }else {
                echo "Passwords didn't match";
            }
             }else{
                 echo "Passwords didn't match";
             }
        }
?>